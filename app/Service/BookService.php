<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Book;
use App\Model\Database;

final class BookService extends Database{
    
    // Get all books from database
    public function getAllBooks(){
        $explorer = $this->explorer;
        $explorer->beginTransaction();
        $rows = $explorer->table('book');
        $explorer->commit();
        $books = array();
        while($row = $rows->fetch()){
            
            $books[$row['id']] = Book::create($row);
            
        }   
        return $books;
    }
    
}