<?php declare(strict_types=1);

class User{

    private int $id;
    private string $nickname;
    private string $password;
    private string $role;

    public function __construct(int $id, string $nickname, string $password, string $role){
        $this->setId($id);
        $this->setNickname($nickname);
        $this->setPassword($password);
        $this->setRole($role);
    }

    public function getId(){
        return $this->id;
    }
    public function setId(int $id){
        $this->id = $id;
    }
    public function getNickname(){
        return $this->nickname;
    }
    public function setNickname(string $nickname){
        $this->nickname = $nickname;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword(string $password){
        $this->password = $password;
    }
    public function getRole(){
        return $this->role;
    }
    public function setRole(string $role){
        $this->role = $role;
    }

    public static function create(?\Nette\Database\Table\ActiveRow $activeRow): ?self{

        if($activeRow===null) return null;

        return new User(...$activeRow->toArray());
    }

}