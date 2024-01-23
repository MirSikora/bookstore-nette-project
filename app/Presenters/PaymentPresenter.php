<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Payment;
use App\Model\Registered;
use App\Model\Transport;
use App\Service\PaymentService;
use Nette;

use Nette\Application\UI\Form;

final class PaymentPresenter extends Nette\Application\UI\Presenter{
    
    /**
	 * @var \App\Service\PaymentService
	 */
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService){
        $this->paymentService=$paymentService;
    }

    public function renderDefault(string $id){
        if(!str_contains($id,'O')){
            $this->redirect('Cart:default');
        } else {  
            $this->template->orderNumber = $id;          
            
            $session = $this->getSession();        
            $section = $this->session->getSection('BOOKS');        
             
            $cartItems = [];
        
            $sumPieces = 0;
            $sumPrice = 0;            
            foreach($section as $item){
                if($item != null){
                    $cartItems[$item['id']] = ['id'=>$item['id'], 'title'=>$item['title'], 'price'=>$item['price']*$item['pieces'], 'pieces'=>$item['pieces'] ]; 
                    $sumPieces += $item['pieces'];
                    $sumPrice += $item['price'] * $item['pieces'];                                        
                }
            }
            if(!empty($cartItems)){            
                 
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
         
        if($sectionOrder['registered'] =='NO'){
            
            $client_id = $this->paymentService->getLastClientId() + 1;            
            $this->paymentService->addNewClient($client_id, Registered::tryFrom($sectionOrder["registered"]),$sectionOrder["firstname"],$sectionOrder["surname"],$sectionOrder["address"],$sectionOrder["city"],$sectionOrder["zip_code"],$sectionOrder["phone_number"],$sectionOrder["email"]);

        } else {

            $client_id = $sectionOrder['client_id'];

        } 
        $this->paymentService->createNewOrder($sectionOrder['orderNumber'], $client_id, $transport, $payment);

        $sectionBook = $this->session->getSection('BOOKS');

        foreach($sectionBook as $item){
            $this->paymentService->addBookToOrder($sectionOrder['orderNumber'],$item['id'],$item['pieces']);
        }

        $sectionOrder->setExpiration('0.001 second');
        $sectionBook->setExpiration('0.001 second');
        $this->flashMessage('Vaše objednávka byla přijata ke zpracování.');
        $this->redirect('Home:default');    
        
    }

    public function actionDelete(string $orderNumber, int $id){
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
                
        $this->redirect('default',$orderNumber);        
    }
    
}