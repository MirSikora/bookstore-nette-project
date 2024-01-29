<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Client;
use App\Model\Database;

final class ClientService extends Database{

    // Return the last saved client id in database.
    public function getLastClientId(){
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        $last_id = $explorer->table('client')->max('client_id');
        $explorer->commit();
        return $last_id;
    }
    
    // Add a new client to database.
    public function addNewClient(int $client_id, bool $registered,string $firstname,string $surname,string $address,string $city,int $zip_code,int $phone_number,string $email){
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        try{
            $explorer->table('client')->insert([
            'client_id' => $client_id,
            'registered' => $registered,
            'firstname' =>	$firstname,
            'surname' =>	$surname,
            'address' =>	$address,
            'city' =>	$city,
            'zip_code' =>	$zip_code,
            'phone_number' =>	$phone_number,
            'email' => $email
            ]);	
            $explorer->commit();
        } catch (\Exception $e){
            $explorer->rollBack();
            throw $e;
        } 
    }

    // When client is registered, this function connects him with the user.
    public function connectClientWithUser(int $client_id){

        $explorer = $this->explorer;
        $explorer->beginTransaction();
        $user_id = $explorer->table('user')->max('id');
        try{
            $explorer->table('user_client_id')->insert([
                'user_id' => $user_id,
                'client_id' => $client_id
            ]);
            $explorer->commit();
        } catch (\Exception $e){
            $explorer->rollBack();
            throw $e;
        } 
    }
   
    // Return client data based on the user id 
    public function getClientByUserId(int $user_id){
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        $row = $explorer->table('user_client_id')->where('user_id ?', $user_id)->fetch();
        $explorer->commit();
        $client = $this->getClientById($row->client_id); 
        return $client;
    }

    // Return client data based on the client id
    public function getClientById(int $client_id):Client{
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        $row = $this->explorer->table('client')->where('client_id',$client_id)->fetch();        
        $explorer->commit();
        return new Client($row['client_id'], boolval($row['registered']), $row['firstname'],$row['surname'],$row['address'],$row['city'],$row['zip_code'],$row['phone_number'],$row['email'],);
    }

    // Control client data, if something hasn't changed
    public function checkClientData(int $client_id, string $firstname,string $surname,string $address,string $city,int $zip_code,int $phone_number,string $email){
        $clientFromDB = $this->getClientById($client_id);
        switch($clientFromDB){
            case $clientFromDB->getFirstname() != $firstname : $result =  false; break;
            case $clientFromDB->getSurname() != $surname : $result =  false; break;
            case $clientFromDB->getAddress() != $address : $result =  false; break;
            case $clientFromDB->getCity() != $city : $result =  false; break;
            case $clientFromDB->getZipCode() != $zip_code : $result =  false; break;
            case $clientFromDB->getPhoneNumber() != $phone_number : $result =  false; break;
            case $clientFromDB->getEmail() != $email : $result =  false; break;
            default : $result = true;
        }
        return $result;
    }
}