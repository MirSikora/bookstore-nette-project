<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class LoginPresenter extends Nette\Application\UI\Presenter
{
    public function createComponentLoginForm(): Nette\Application\UI\Form {        
        
        $form = new Nette\Application\UI\Form();
        $form->addText('nickname', '')->setHtmlAttribute('placeholder', 'Přihlašovací jméno')->setRequired('Zadejte přihlašovací jméno.');
        $form->addPassword('password', '')->setHtmlAttribute('placeholder', 'Heslo')->setRequired('Zadejte heslo.');
        $form->addSubmit('send','Přihlásit se');
        $form->onSuccess[] = [$this, 'logUser'];        
        return $form;        
    }

    public function logUser(Nette\Application\UI\Form $form){
        $values = $form->getValues();
        try{
            $this->getUser()->login($values->nickname, $values->password);           
            $this->flashMessage('Vítejte ' . $values->nickname . '!');
            $this->redirect('User:'); 
        }catch (Nette\Security\AuthenticationException $e){
            $this->flashMessage($e->getMessage(),'Přihlášení se nezdařilo');
        }                                        
    }

    public function actionOut(){
        $this->getUser()->logout(true);
        $session = $this->getSession();
        $sectionOrder = $this->session->getSection('ORDER');
        $sectionBooks = $this->session->getSection('BOOKS');
        $sectionOrder->setExpiration('0.001 second');
        $sectionBooks->setExpiration('0.001 second');
        $this->flashMessage('Odhlášení bylo úspěšné.');
        $this->redirect('default');
        exit();
    }
}