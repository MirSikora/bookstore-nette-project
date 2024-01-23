<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class DeliveryPresenter extends Nette\Application\UI\Presenter{
    
    public function renderDefault(string $id){
        $this->template->allowed = false;
        if(!str_contains($id,'O')){
            $this->redirect('Cart:default');
        } else {
            $session = $this->getSession();
            $section = $session->getSection('ORDER'); 
            if($section['firstname']!=null){
                $this->template->allowed = true;
            }            
            $this->template->orderNumber = $id;                                
        }
    }
    
    public function createComponentClientInfoForm(){
        $session = $this->getSession();
        $section = $session->getSection('ORDER');
        $form = new Form();
   
        $form->addHidden('registered')->setDefaultValue('NO');
        $form->addHidden('client_id')->setDefaultValue(0);   
        $form->addText('firstname')->setHtmlAttribute(!$section['orderNumber'] ? "placeholder = 'Jméno'" : '')->setDefaultValue($section['orderNumber'] ? $section['firstname'] : '')->setRequired('Zadejte prosím Vaše jméno');
        $form->addText('surname')->setHtmlAttribute(!$section['orderNumber'] ? "placeholder='Příjmení'" : '')->setDefaultValue($section['orderNumber'] ? $section['surname'] :'')->setRequired('Zadejte prosím Vaše příjmení');
        $form->addEmail('email')->setHtmlAttribute(!$section['orderNumber'] ? "placeholder='Email'" : '')->setDefaultValue($section['orderNumber'] ? $section['email'] :'')->setRequired('Zadejte prosím Váš email');
        $form->addInteger('phone_number')->setHtmlAttribute(!$section['orderNumber'] ? "placeholder='Telefon'" : '')->setDefaultValue($section['orderNumber'] ? $section['phone_number'] :'')->setRequired('Zadejte prosím Váš telefon');
        $form->addText('address')->setHtmlAttribute(!$section['orderNumber'] ? "placeholder='Adresa'" : '')->setDefaultValue($section['orderNumber'] ? $section['address'] :'')->setRequired('Zadejte prosím Vaši adresu');
        $form->addText('city')->setHtmlAttribute(!$section['orderNumber'] ? "placeholder='Město'" : '')->setDefaultValue($section['orderNumber'] ? $section['city'] :'')->setRequired('Zadejte prosím město');
        $form->addInteger('zip_code')->setHtmlAttribute(!$section['orderNumber'] ? "placeholder='PSČ'" : '')->setDefaultValue($section['orderNumber'] ? $section['zip_code'] :'')->setRequired('Zadejte prosím PSČ')->addRule($form::MinLength, 'Minimální délka PSČ je %d čísel', 5);
        $form->addCheckbox('GDPR')->setRequired('Musíte dát souhlas se zpracováním osobních údajů');
        $form->addHidden('orderNumber');  
        $form->addSubmit('continue');
        $form->onSuccess[]=[$this, 'completeDelivery'];
        return $form;
    }

    public function completeDelivery(Form $form, $values){
        $values = $form->getValues(); 
        $session = $this->getSession();
        $section = $session->getSection('ORDER');         
        foreach ($values as $key => $value) {
            
            $section->set($key, $value);
        }
        $this->redirect('Payment:default', $values['orderNumber']);
    }

    
}