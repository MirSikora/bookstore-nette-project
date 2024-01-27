<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Service\ClientService;
use Nette;
use Nette\Application\UI\Form;

final class DeliveryPresenter extends Nette\Application\UI\Presenter
{

    /**
     * @var \App\Service\ClientService
     */
    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function renderDefault(string $id)
    {
        $this->template->allowed = false;
        if (!str_contains($id, 'O')) {
            $this->redirect('Cart:default');
        } else {
            $session = $this->getSession();
            $section = $session->getSection('ORDER');
            if ($section['firstname'] != null) {
                $this->template->allowed = true;
            }
            $this->template->orderNumber = $id;
        }
    }

    public function createComponentClientInfoForm()
    {
        $session = $this->getSession();
        $section = $session->getSection('ORDER');
        $form = new Form();

        $registeredUser = false;
        if ($this->user->isLoggedIn()) {
            $client = $this->clientService->getClientByUserId($this->user->getId());
            $registeredUser = true;
        }

        $form->addHidden('registered')->setDefaultValue($registeredUser ? true : false);
        $form->addHidden('client_id')->setDefaultValue($registeredUser ? $client->getClientId() : 0);
        $form->addText('firstname')->setHtmlAttribute(!($section['orderNumber'] and $registeredUser) ? "placeholder = 'Jméno'" : '')->setDefaultValue($section['orderNumber'] ? $section['firstname'] : ($registeredUser ? $client->getFirstname() : ''))->setRequired('Zadejte prosím Vaše jméno');
        $form->addText('surname')->setHtmlAttribute(!($section['orderNumber'] and $registeredUser) ? "placeholder='Příjmení'" : '')->setDefaultValue($section['orderNumber'] ? $section['surname'] : ($registeredUser ? $client->getSurname() : ''))->setRequired('Zadejte prosím Vaše příjmení');
        $form->addEmail('email')->setHtmlAttribute(!($section['orderNumber'] and $registeredUser) ? "placeholder='Email'" : '')->setDefaultValue($section['orderNumber'] ? $section['email'] : ($registeredUser ? $client->getEmail() : ''))->setRequired('Zadejte prosím Váš email');
        $form->addInteger('phone_number')->setHtmlAttribute(!($section['orderNumber'] and $registeredUser) ? "placeholder='Telefon'" : '')->setDefaultValue($section['orderNumber'] ? $section['phone_number'] : ($registeredUser ? $client->getPhoneNumber() : ''))->setRequired('Zadejte prosím Váš telefon');
        $form->addText('address')->setHtmlAttribute(!($section['orderNumber'] and $registeredUser) ? "placeholder='Adresa'" : '')->setDefaultValue($section['orderNumber'] ? $section['address'] : ($registeredUser ? $client->getAddress() : ''))->setRequired('Zadejte prosím Vaši adresu');
        $form->addText('city')->setHtmlAttribute(!($section['orderNumber'] and $registeredUser) ? "placeholder='Město'" : '')->setDefaultValue($section['orderNumber'] ? $section['city'] : ($registeredUser ? $client->getCity() : ''))->setRequired('Zadejte prosím město');
        $form->addInteger('zip_code')->setHtmlAttribute(!($section['orderNumber'] and $registeredUser) ? "placeholder='PSČ'" : '')->setDefaultValue($section['orderNumber'] ? $section['zip_code'] : ($registeredUser ? $client->getZipCode() : ''))->setRequired('Zadejte prosím PSČ')->addRule($form::MinLength, 'Minimální délka PSČ je %d čísel', 5);
        $form->addCheckbox('GDPR')->setValue($section['orderNumber'] ? 'checked' : '')->setRequired('Musíte dát souhlas se zpracováním osobních údajů');
        $form->addHidden('orderNumber');
        $form->addSubmit('continue');
        $form->onSuccess[] = [$this, 'completeDelivery'];
        return $form;
    }

    // Save all user's data in session section 'ORDER'
    public function completeDelivery(Form $form, $values)
    {
        $values = $form->getValues();
        $session = $this->getSession();
        $section = $session->getSection('ORDER');
        $section->setExpiration('20 minutes');
        foreach ($values as $key => $value) {

            $section->set($key, $value);
            
        }
        $this->redirect('Payment:default', $values['orderNumber']);
    }


}