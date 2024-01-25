<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Book;
use App\Model\Database;

final class HomeService extends Database{
    
    public function getAllBooks(){
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        $rows = $explorer->table('book');
        $explorer->commit();
        $books = array();
        while($row = $rows->fetch()){
            $book = new Book($row['id'],$row['title'],$row['author_firstname'],$row['author_surname'],$row['description'],$row['price'],$row['pieces']);            
            $books[$row['id']]=$book;
        }   
        return $books;
    }
    
}