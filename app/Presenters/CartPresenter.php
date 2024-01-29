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
                     
        $cartItems = $this->orderService->getCartItemsFromSession();        
        $sumPieces = $this->orderService->sumPiecesInCart();
        $sumPrice = $this->orderService->sumPriceInCart();            
                
        if(!empty($cartItems)){
            $session = $this->getSession();             
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
        
        $this->orderService->deletePiece($id);
        
        $this->redirect('default');        
    }

    public function actionDeleteAll(){
        $session = $this->getSession();
        $section = $this->session->getSection('BOOKS');
        $section->setExpiration('0.001 second');              
        $this->redirect('Cart:default');
    }
    
    
}