<?php

declare(strict_types=1);

namespace App\Presenters;
use BasePresenter;
use \UserService;
use Nette;


final class UserPresenter extends BasePresenter
{
    /**
	 * @var \UserService     
     */
    protected UserService $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    
    public function renderDefault(): void{
        $id= $this->user->getIdentity()->getId(); 
        $this->redirect('Home:');        
    }
       
}