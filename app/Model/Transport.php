<?php
declare(strict_types=1);

namespace App\Model;

use Nette\SmartObject;

enum Transport:string{
    case CP = 'CP';
    case PPL = 'PPL';
    case GLS = 'GLS';
}