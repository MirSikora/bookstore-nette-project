<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Payment;
use App\Model\Transport;
use App\Service\ClientService;
use App\Service\OrderService;
use Nette;
use Nette\Application\UI\Form;

final class PaymentPresenter extends Nette\Application\UI\Presenter{
    
    /**
	 * @var \App\Service\OrderService
     * @var \App\Service\ClientService
     */
    protected OrderService $orderService;
    protected ClientService $clientService;

    public function __construct(OrderService $orderService, ClientService $clientService){
        $this->orderService = $orderService;
        $this->clientService = $clientService;
    }

    public function renderDefault(string $id){
        if(!str_contains($id,'O')){
            $this->redirect('Cart:default');
        } else {  
            $this->template->orderNumber = $id;          
                        
            $cartItems = $this->orderService->getCartItemsFromSession();        
            $sumPieces = $this->orderService->sumPiecesInCart();
            $sumPrice = $this->orderService->sumPriceInCart();
                    
            if(!empty($cartItems)){            
                $session = $this->getSession();  
                $section= $this->session->getSection('ORDER');
                $orderData = ['firstname' => $section['firstname'], 'surname' => $section['surname'], 'address' => $section['address'], 'city' => $section['city'],'zip_code' => strval($section['zip_code'])];

                $this->template->orderData = $orderData;
                $this->template->cartItems = $cartItems;
                $this->template->sumPieces = $sumPieces;  
                $this->template->sumPrice = $sumPrice;                
                
            }else{ 

                $this->session->getSection('ORDER')->setExpiration('0.001 second');                
                $this->redirect('Cart:default');
            }  
        }
    }

    public function actionBack(string $orderNumber){
        $this->redirect('Delivery:default', $orderNumber);
    }

    public function createComponentTransportForm(){
        $form = new Form();        
        $form->addRadioList('transport','Transport:',['CP'=>Transport::CP, 'PPL'=>Transport::PPL, 'GLS'=>Transport::GLS])->setDefaultValue('CP')->checkDefaultValue(true)->getSelectedItem();            
        $form->addRadioList('payment','Payment:',['CASH'=>Payment::CASH,'CARD'=>Payment::CARD])->setDefaultValue('CASH')->checkDefaultValue(true)->getSelectedItem();
        $form->addSubmit('finish');
        $form->onSuccess[]=[$this, 'finishOrder'];
        return $form;        
    }

    public function finishOrder(Form $form,$values){
        $values=$form->getValues();
        $transport = Transport::tryFrom($values['transport']);
        $payment = Payment::tryFrom($values['payment']); 
            
        $session = $this->getSession();
        $sectionOrder = $this->session->getSection('ORDER'); 

        $reviewedClient = false;
        
        if(boolval($sectionOrder['registered'])){
            $reviewedClient = $this->clientService->checkClientData(intval($sectionOrder["client_id"]),$sectionOrder["firstname"],$sectionOrder["surname"],$sectionOrder["address"],$sectionOrder["city"],$sectionOrder["zip_code"],$sectionOrder["phone_number"],$sectionOrder["email"]);
        }

        if(boolval($sectionOrder['registered']) and $reviewedClient){

            $client_id = intval($sectionOrder['client_id']);

        }else{
            
            $client_id = $this->clientService->getLastClientId() + 1;            
            $this->clientService->addNewClient($client_id,boolval($sectionOrder["registered"]),$sectionOrder["firstname"],$sectionOrder["surname"],$sectionOrder["address"],$sectionOrder["city"],$sectionOrder["zip_code"],$sectionOrder["phone_number"],$sectionOrder["email"]);

        }

        $this->orderService->createNewOrder($sectionOrder['orderNumber'], $client_id, $transport, $payment);

        $sectionBooks = $this->session->getSection('BOOKS');

        foreach($sectionBooks as $item){
            $this->orderService->addBookToOrder($sectionOrder['orderNumber'],$item['id'],$item['pieces']);
        }

        $sectionOrder->setExpiration('0.001 second');
        $sectionBooks->setExpiration('0.001 second');
        $this->flashMessage('Vaše objednávka byla přijata ke zpracování.');
        $this->redirect('Home:default');    
        
    }

    public function actionDelete(string $orderNumber, int $id){
        
        $this->orderService->deletePiece($id);
                
        $this->redirect('default',$orderNumber);        
    }
    
}