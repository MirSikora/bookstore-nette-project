<?php
declare(strict_types=1);

namespace App\Model;

use Nette\SmartObject;

enum Payment:string{
    case CASH = 'CASH';
    case CARD = 'CARD';
}