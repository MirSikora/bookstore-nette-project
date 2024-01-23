<?php
declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\SmartObject;

class Database{

    use SmartObject;

    protected Explorer $explorer;

    function __construct(Explorer $explorer){
        $this->explorer = $explorer;
    } 
    
}