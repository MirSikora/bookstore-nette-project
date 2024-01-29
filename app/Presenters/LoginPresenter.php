<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class LoginPresenter extends Nette\Application\UI\Presenter
{
    public function createComponentLoginForm(): Form {        
        
        $form = new Form();
        $form->addText('nickname', '')->setHtmlAttribute('placeholder', 'Přihlašovací jméno')->setRequired('Zadejte přihlašovací jméno.');
        $form->addPassword('password', '')->setHtmlAttribute('placeholder', 'Heslo')->setRequired('Zadejte heslo.');
        $form->addSubmit('send','Přihlásit se');
        $form->onSuccess[] = [$this, 'logUser'];        
        return $form;        
    }

    public function logUser(Form $form){
        $values = $form->getValues();
        try{
            $this->getUser()->login($values->nickname, $values->password);           
            $this->flashMessage('Vítejte v novém e-shopu s knihami!');
            $this->redirect('User:'); 
        }catch (Nette\Security\AuthenticationException $e){
            $this->flashMessage($e->getMessage());
        }                                        
    }

    public function actionOut(){
        $this->getUser()->logout(true);

        // Delete user's order in session's sections
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