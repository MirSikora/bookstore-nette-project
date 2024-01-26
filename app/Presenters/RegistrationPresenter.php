<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Service\ClientService;
use \UserService;
use Nette\Application\UI\Form;

final class RegistrationPresenter extends Nette\Application\UI\Presenter
{
    /**
	 * @var \UserService
     * @var \App\Service\ClientService
     */
    protected UserService $userService;
    protected ClientService $clientService;

    public function __construct(UserService $userService, ClientService $clientService){
        $this->userService = $userService;
        $this->clientService = $clientService;
    }

    public function createComponentRegistrationForm(){
        $form = new Form();
        $form->addText('firstname', '')->setHtmlAttribute('placeholder', 'Jméno')->setRequired('Zadejte prosím jméno');
        $form->addText('surname', '')->setHtmlAttribute('placeholder', 'Příjmení')->setRequired('Zadejte prosím příjmení');
        $form->addEmail('email', '')->setHtmlAttribute('placeholder', 'Email')->setRequired('Zadejte prosím email');
        $form->addInteger('phone_number', '')->setHtmlAttribute('placeholder', 'Telefon')->setRequired('Zadejte prosím telefon');
        $form->addText('address', '')->setHtmlAttribute('placeholder', 'Adresa')->setRequired('Zadejte prosím adresu');
        $form->addText('city', '')->setHtmlAttribute('placeholder', 'Město')->setRequired('Zadejte prosím město');
        $form->addInteger('zip_code', '')->setHtmlAttribute('placeholder', 'PSČ')->setRequired('Zadejte prosím PSČ');
        $form->addText('nickname', '')->setHtmlAttribute('placeholder', 'Přihlašovací jméno')->setRequired('Zadejte prosím přihlašovací jméno');
        $form->addPassword('password', '')->setHtmlAttribute('placeholder', 'Heslo')->setRequired('Zadejte prosím heslo');
        $form->addPassword('passwordVerify', '')->setHtmlAttribute('placeholder', 'Heslo znovu')
        ->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
        ->addRule($form::Equal, 'Hesla se neshodují', $form['password'])
        ->setOmitted();        
        $form->addSubmit('insert', 'Zaregistrovat se');
        $form->onSuccess[] = [$this, 'addUserToDatabase'];                
        return $form;        
    }

    public function addUserToDatabase(Form $form, $values){
        $values = $form->getValues(); 
        if($this->userService->findUser($values['nickname']) != NULL){
            $form['nickname']->setValue("")->addError('Zadaný uživatel již existuje');
            $this->flashMessage('Zadaný uživatel již existuje');
        }else{
            $values['role']='USER'; 
            $oldPassword = $values['password'];                      
            $values['password']=password_hash($values['password'], PASSWORD_DEFAULT); 

            // Create a new client
            $client_id = $this->clientService->getLastClientId() + 1;            
            $this->clientService->addNewClient($client_id, true ,$values["firstname"],$values["surname"],$values["address"],$values["city"],$values["zip_code"],$values["phone_number"],$values["email"]);

            // Create a new user
            $this->userService->addNewUser($values['nickname'],$values['password']);

            // Connect this client with this user
            $this->clientService->connectClientWithUser($client_id);

            $this->flashMessage('Vaše registrace byla úspěšná. Vítejte!'); 
            $this->getUser()->login($values->nickname, $oldPassword);        
            $this->redirect('User:'); 
        }
        
        	    
    }
    
}