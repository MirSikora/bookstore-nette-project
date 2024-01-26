<?php
declare(strict_types=1);

namespace App\Model;

use Nette\SmartObject;

/**
 * @property int $client_id
 * @property-read bool $registered
 * @property string $firstname
 * @property string $surname
 * @property string $address
 * @property string $city
 * @property int $zip_code
 * @property int $phone_number
 * @property string $email
 */
class Client
{
    use SmartObject;

    private int $client_id;
    private bool $registered;
    private string $firstname;
    private string $surname;
    private string $address;   
    private string $city;
    private int $zip_code;
    private int $phone_number;
    private string $email;

    public function __construct(int $client_id, bool $registered, string $firstname, string $surname, string $address, string $city, int $zip_code, int $phone_number, string $email)
    {
        $this->setClientId($client_id);
        $this->setRegistered($registered);
        $this->setFirstname($firstname);
        $this->setSurname($surname);
        $this->setAddress($address);        
        $this->setCity($city);
        $this->setZipCode($zip_code);
        $this->setPhoneNumber($phone_number);
        $this->setEmail($email);
    }

    public function getClientId()
    {
        return $this->client_id;
    }
    public function setClientId(int $client_id)
    {
        $this->client_id = $client_id;
    }
    public function isRegistered()
    {
        return $this->registered>0;
    }
    public function setRegistered($registered){
        $this->registered = $registered > 0 ? true : false;
    }    
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function setAddress(string $address)
    {
        $this->address = $address;
    }    
    public function getCity()
    {
        return $this->city;
    }
    public function setCity(string $city)
    {
        $this->city = $city;
    }
    public function getZipCode()
    {
        return $this->zip_code;
    }
    public function setZipCode(int $zip_code)
    {
        $this->zip_code = $zip_code;
    }
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
    public function setPhoneNumber(int $phone_number)
    {
        $this->phone_number = $phone_number;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }    

}