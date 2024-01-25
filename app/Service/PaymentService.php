<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Database;
use App\Model\Payment;
use App\Model\Registered;
use App\Model\Transport;

final class PaymentService extends Database{

    

    public function createNewOrder(string $order_number, int $client_id, Transport $transport, Payment $payment){
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        try{
            $explorer->table('order_data')->insert([
            'order_number' => $order_number,              
            'client_id' => $client_id,            
            'transport' =>	$transport,
            'payment' =>	$payment            
            ]);	
            $explorer->commit();
        } catch (\Exception $e){
            $explorer->rollBack();
            throw $e;
        }                 
    }

    public function addBookToOrder(string $order_number, int $book_id, int $quantity){
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        try{
            $explorer->table('order_detail')->insert([
            'order_number' => $order_number,  
            'book_id' => $book_id,            
            'quantity' =>	$quantity          
            ]);	
            $explorer->table('book')->where('id',$book_id)->update(['pieces-=' => $quantity]);
            $explorer->commit();
        } catch (\Exception $e){
            $explorer->rollBack();
            throw $e;
        }           
    }
    
}