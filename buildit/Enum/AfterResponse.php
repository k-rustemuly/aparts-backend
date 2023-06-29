<?php

declare(strict_types=1);

namespace Buildit\Enum;

enum AfterResponse: string
{
    case RELOAD = 'reload';
    case BACK = 'back';
    case REPEAT = 'repeat';
    case UPDATE = 'update';
    case CLOSE = 'close';
}
