<?php declare(strict_types=1);

use Nette\Security\IIdentity;

class Authenticator implements \Nette\Security\Authenticator { 

    public function __construct(
        private UserService $userService,
        private Nette\Security\Passwords $passwords
    ){}

    // This function control user's nickname and password and return SimpleIdentity
    public function authenticate(string $nickname, string $password): IIdentity {
        $user = $this->userService->findUser($nickname);
        
        if(($user === null)or($this->passwords->verify($password, $user->getPassword()) === false))
            throw new \Nette\Security\AuthenticationException('Nesprávně zadané uživatelské jméno nebo heslo!');        

        return new \Nette\Security\SimpleIdentity ($user->getId(), $user->getRole(), ['nickname' => $nickname]);

    }
}