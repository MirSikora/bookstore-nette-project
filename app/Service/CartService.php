<?php
declare(strict_types=1);

namespace App\Service;
use App\Model\Book;
use App\Model\Database;

final class CartService extends Database{
    
    
    public function getOrderId(){        
        $this->explorer->beginTransaction();
        $row = $this->explorer->table('order_data')->max('order_id');
        $this->explorer->commit();        
        return $row;
    }
    
    
}