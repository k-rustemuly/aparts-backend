<?php

declare(strict_types=1);

namespace Buildit\Enum;

enum VisibilityType: string
{
    case VISIBLE = 'visible';
    case HIDDEN = 'hidden';
    case INVISIBLE = 'invisible';
    case READONLY = 'readonly';
    case DISABLED = 'disabled';
}
