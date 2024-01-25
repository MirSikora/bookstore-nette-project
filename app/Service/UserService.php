<?php declare(strict_types=1);

use App\Model\Database;

class UserService extends Database {    

    // data for Authenticator
    public function findUser(string $nickname): ?User{
        
        return User::create($this->explorer->table('user')->where('nickname',$nickname)->fetch());
    }

    // data for UserPresenter
    public function getUserInfo (int $id): ?User{

        return User::create($this->explorer->table('user')->where('id',$id)->fetch());
    }

    // create new user by registration form
    public function addNewUser(string $nickname, string $password){

        $explorer = $this->explorer;
        $explorer->beginTransaction();
        try{
            $explorer->table('user')->insert([
            'nickname' => $nickname,              
            'password' => $password,
            'role' => 'USER'         
            ]);	
            $explorer->commit();
        } catch (\Exception $e){
            $explorer->rollBack();
            throw $e;
        }          
    }

    
}