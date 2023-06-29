<?php

declare(strict_types=1);

namespace Buildit\Enum;

enum Color: string
{
    case SUCCESS = '#66bb6a';
    case INFO = '#29b6f6';
    case WARNING = '#ffa726';
    case ERROR = '#f44336';
    case WHITE = '#ffffff';
    case TRANSPARENT = '#ffffff00';
    case BLACK = '#000000';
}
