<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Service\OrderService;
use Nette;

final class CartPresenter extends Nette\Application\UI\Presenter{

    /**
	 * @var \App\Service\OrderService
	 */
    protected OrderService $orderService; 
          
    
    public function __construct(OrderService $orderService){
        $this->orderService=$orderService;                                     
    }

    public function renderDefault(){        
        $this->template->allowed = false;
        $session = $this->getSession();        
        $section = $this->session->getSection('BOOKS');        
             
        $cartItems = [];
        
        $sumPieces = 0;
        $sumPrice = 0;            
        foreach($section as $item){
            if($item != null){
                
                $cartItems[$item['id']] = ['id'=>$item['id'], 'title'=>$item['title'], 'price'=>$item['price']*$item['pieces'], 'pieces'=>$item['pieces'] ]; 
                $sumPieces += $item['pieces'];
                $sumPrice += $item['price']*$item['pieces'];                                        
            }
        }
        if(!empty($cartItems)){            
            $section = $this->session->getSection('ORDER');
            if($section['firstname']!=null){
                $this->template->allowed = true;
            }

            $this->template->cartItems = $cartItems;
            $this->template->sumPieces = $sumPieces;  
            $this->template->sumPrice = $sumPrice;
            
            // Add a new order number to the order
            $orderId = $this->orderService->getOrderId() + 1;
            $orderNumber = time(). 'O' . ($orderId < 10 ? '000' : ($orderId<100 ? '00' : '0')).$orderId;
            $this->template->orderNumber = $orderNumber;            
           
        }else{  
            // When client delete gradually everything to zero, this delete the session section ORDER           
            $this->session->getSection('ORDER')->setExpiration('0.001 second');
            
            $this->template->emptyCart = 'Váš nákupní košík je prázdný';
        }        
    }

    public function actionDelete(int $id){
        $delId = strval($id); 
        $session = $this->getSession();
        $section = $this->session->getSection('BOOKS');
        if($section[$delId]['pieces']>1){
            $oldPieces=0;        
            $oldPieces = $section[$delId]['pieces'];
            $newPieces = $oldPieces - 1;
            $section[$delId] = array("id"=>$id,"title"=>$section[$delId]['title'], "price"=>$section[$delId]['price'],"pieces"=>$newPieces);            
        } else {
            $section[$delId]= null;
        }
        
        $this->redirect('default');        
    }

    public function actionDeleteAll(){
        $session = $this->getSession();
        $section = $this->session->getSection('BOOKS');
        $section->setExpiration('0.001 second');              
        $this->redirect('Cart:default');
    }
    
    
}