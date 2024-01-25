<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Database;

final class CartService extends Database{
    
    
    public function getOrderId(){ 
        $explorer = $this->explorer;       
        $explorer->beginTransaction();
        $row = $explorer->table('order_data')->max('order_id');
        $explorer->commit();        
        return $row;
    }
    
    
}