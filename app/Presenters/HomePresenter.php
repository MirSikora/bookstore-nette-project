<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Service\BookService;
use Nette\Application\UI\Form;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    /**
	 * @var \App\Service\BookService
	 */
    protected BookService $bookService;    
       

    public function __construct(BookService $bookService){
        $this->bookService=$bookService;                       
    }

    public function renderDefault(){
        $session = $this->getSession();
        $section = $session->getSection('BOOKS');        
        
        $books = $this->bookService->getAllBooks(); 
        
        
            foreach ($books as $book) {            
                     
                if ($section[strval($book->getId())]!=NULL){
                    if($book->getId()==$section[strval($book->getId())]['id']){
                
                        $book->setPieces(intval($book->getPieces() - ($section[strval($book->getId())])['pieces']));
                    }                             
                }
                if($book->getPieces()==0){
                    $books[strval($book->getId())] = [];
                } 
            } 
                        
        if(!array_filter($books)){

            $this->template->emptyBooks = 'Omlouváme se, ale nemáme žádné knihy skladem.';
            
        } else {
            
            $this->template->books = $books;

        }
        
        $sendPieces = 0;
        $sendPrice = 0;
         foreach ($section as $item) {
            
            if(is_array($item)){
                $sendPieces += $item['pieces'];
                $sendPrice += intval($item['price'])*$item['pieces'];
            }               
        }
        if($sendPieces>0){
            $this->template->cartPieces = $sendPieces;
            $this->template->cartPrice = $sendPrice;            
        }                 
    }
    
    public function createComponentCartForm():Form {
        $form = new Form();        
        $form->addHidden('id');
        $form->addHidden('price');
		$form->addInteger('pieces')->setDefaultValue('')->setRequired('Zadejte počet kusů.');			
		$form->addSubmit('toCart');
        $form->onSuccess[] = [$this, 'addToCart'];             
        return $form;        
    }

    public function addToCart(Form $form, $values){
        $values = $form->getValues();        
        $form->reset();
        $session = $this->getSession();
        $section = $session->getSection('BOOKS');
        $books = $this->bookService->getAllBooks();
        $dbPieces = $books[$values['id']]->getPieces();         
        $addPieces = $values['pieces'];        
        
        if($section[($values["id"])]){
            $addPieces = $addPieces + $section[$values["id"]]['pieces'];
        }
               
        if ($dbPieces >= $addPieces){
            
            $itemValues = array("id"=>intval($values["id"]),"title"=>$books[$values["id"]]->getTitle() ,"price"=>$values["price"], "pieces"=>intval($values["pieces"]));            
            
            if(!($section[$values["id"]])){
                $section[$values["id"]]= $itemValues;           
            }else{
                $oldPieces=0;        
                $oldPieces = ($section[$values["id"]])['pieces'];
                $newPieces = $oldPieces + intval($values["pieces"]);
                $section[$values['id']] = array("id"=>intval($values["id"]), "title"=>$books[$values["id"]]->getTitle() ,"price"=>$values["price"],"pieces"=>$newPieces);           
            }          
        }                
    }

}
