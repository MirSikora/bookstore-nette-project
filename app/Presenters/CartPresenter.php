<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Service\CartService;

final class CartPresenter extends Nette\Application\UI\Presenter{

    /**
	 * @var \App\Service\CartService
	 */
    protected CartService $cartService; 
          
    
    public function __construct(CartService $cartService){
        $this->cartService=$cartService;                                     
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
            
            $orderId = $this->cartService->getOrderId() + 1;
            $orderNumber = time(). 'O' . ($orderId < 10 ? '000' : ($orderId<100 ? '00' : '0')).$orderId;
            $this->template->orderNumber = $orderNumber;            
           
        }else{            
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