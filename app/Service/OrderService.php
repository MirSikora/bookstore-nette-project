<?php
declare(strict_types=1);

namespace App\Service;

use Nette\Database\Explorer;
use App\Model\Payment;
use App\Model\Transport;
use Nette\Http\Session;

final class OrderService{

    protected Explorer $explorer;
    // Creating a variable of Session class, because it doesn't inherit from presenter and i need to access it in a method deletePiece()
    protected Session $session;
    

    public function __construct(Explorer $explorer, Session $session){
        $this->explorer = $explorer;
        $this->session = $session;
    }
    
    // Get the last order id from database.
    public function getOrderId(){ 
        $explorer = $this->explorer;       
        $explorer->beginTransaction();
        $row = $explorer->table('order_data')->max('order_id');
        $explorer->commit();        
        return $row;
    }

    // Create a new order with unique order number, order date include by database and others info.
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

    // Connect content of the order with order number. 
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

    // Delete piece from session section BOOKS
    public function deletePiece(int $id){
        $delId = strval($id);       
        
        $section = $this->session->getSection('BOOKS');
        if($section[$delId]['pieces']>1){
            $oldPieces=0;        
            $oldPieces = $section[$delId]['pieces'];
            $newPieces = $oldPieces - 1;
            $section[$delId] = array("id"=>$id,"title"=>$section[$delId]['title'], "price"=>$section[$delId]['price'],"pieces"=>$newPieces);            
        } else {
            $section[$delId]= null;
        }
    }

    public function getCartItemsFromSession(): array{
        $section = $this->session->getSection('BOOKS');
        $cartItems = [];
        foreach($section as $item){
            if($item != null){
                $cartItems[$item['id']] = ['id'=>$item['id'], 'title'=>$item['title'], 'price'=>$item['price']*$item['pieces'], 'pieces'=>$item['pieces'] ]; 
            }
        }
        return $cartItems;
    }

    public function sumPiecesInCart():int{
        $section = $this->session->getSection('BOOKS');
        $sumPieces = 0;
        foreach($section as $item){
            if($item != null){
                $sumPieces += $item['pieces']; 
            }
        }
        return $sumPieces;
    }

    public function sumPriceInCart():float{
        $section = $this->session->getSection('BOOKS');        
        $sumPrice = 0;            
        foreach($section as $item){
            if($item != null){
                $sumPrice += $item['price'] * $item['pieces'];                                       
            }
        }
        return $sumPrice;
    }

    
}