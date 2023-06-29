<?php

declare(strict_types=1);

namespace Buildit\Facades;

use Illuminate\Support\Facades\Facade;

class Buildit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'buildit';
    }
}
