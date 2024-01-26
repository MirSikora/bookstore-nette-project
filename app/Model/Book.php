<?php
declare(strict_types=1);

namespace App\Model;

use Nette\SmartObject;

/**
 * @property int $id
 * @property string $title
 * @property string $author_firstname
 * @property string $author_surname
 * @property string $description
 * @property string $image
 * @property float $price
 * @property int $pieces
 */
class Book{

    use SmartObject;
    
    private int $id;
    private string $title;
    private string $author_firstname;
    private string $author_surname;
    private string $description;
    private string $image;
    private float $price;
    private int $pieces;

    public function __construct(int $id, string $title,string $author_firstname,string $author_surname,string $description, string $image, float $price,int $pieces){
        $this->setId($id);
        $this->setTitle($title);
        $this->setAuthorFirstname($author_firstname);
        $this->setAuthorSurname($author_surname);
        $this->setDescription($description);
        $this->setImage($image);
        $this->setPrice($price);
        $this->setPieces($pieces);
    }
    public function setId(int $id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    public function setTitle(string $title){
        $this->title = $title;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setAuthorFirstname(string $author_firstname){
        $this->author_firstname = $author_firstname;
    }
    public function getAuthorFirstname(){
        return $this->author_firstname;
    }
    public function setAuthorSurname(string $author_surname){
        $this->author_surname = $author_surname;
    }
    public function getAuthorSurname(){
        return $this->author_surname;
    }
    public function setDescription(string $description){
        $this->description = $description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setImage(string $image){
        $this->image = $image;
    }
    public function getImage(){
        return $this->image;
    }
    public function setPrice(float $price){
        $this->price = $price;
    }
    public function getPrice(){
        return $this->price;
    }
    public function setPieces(int $pieces){
        $this->pieces = $pieces;
    }
    public function getPieces(){
        return $this->pieces;
    }
}