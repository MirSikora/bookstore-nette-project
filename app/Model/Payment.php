<?php
declare(strict_types=1);

namespace App\Model;

enum Payment:string{
    case CASH = 'CASH';
    case CARD = 'CARD';
}