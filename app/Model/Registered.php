<?php
declare(strict_types=1);

namespace App\Model;

use Nette\SmartObject;

enum Registered: string{
    case YES = 'YES';
    case NO = 'NO';
}