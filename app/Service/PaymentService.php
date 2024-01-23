<?php
declare(strict_types=1);

namespace App\Service;
use App\Model\Database;
use App\Model\Payment;
use App\Model\Registered;
use App\Model\Transport;

final class PaymentService extends Database{

    public function getLastClientId(){
        $this->explorer->beginTransaction();
        $last_id = $this->explorer->table('client')->max('client_id');
        $this->explorer->commit();
        return $last_id;
    }
    
    public function addNewClient(int $client_id, Registered $registered,string $firstname,string $surname,string $address,string $city,int $zip_code,int $phone_number,string $email){
        $this->explorer->beginTransaction();
        try{
            $this->explorer->table('client')->insert([
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
            $this->explorer->commit();
        } catch (\Exception $e){
            $this->explorer->rollBack();
            throw $e;
        } 
    }

    public function createNewOrder(string $order_number, int $client_id, Transport $transport, Payment $payment){
        $this->explorer->beginTransaction();
        try{
            $this->explorer->table('order_data')->insert([
            'order_number' => $order_number,              
            'client_id' => $client_id,            
            'transport' =>	$transport,
            'payment' =>	$payment            
            ]);	
            $this->explorer->commit();
        } catch (\Exception $e){
            $this->explorer->rollBack();
            throw $e;
        }                 
    }

    public function addBookToOrder(string $order_number, int $book_id, int $quantity){
        $this->explorer->beginTransaction();
        try{
            $this->explorer->table('order_detail')->insert([
            'order_number' => $order_number,  
            'book_id' => $book_id,            
            'quantity' =>	$quantity          
            ]);	
            $this->explorer->table('book')->where('id',$book_id)->update(['pieces-=' => $quantity]);
            $this->explorer->commit();
        } catch (\Exception $e){
            $this->explorer->rollBack();
            throw $e;
        }           
    }
    
}