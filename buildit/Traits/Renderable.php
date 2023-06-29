<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait Renderable
{
    public static function render(): array
    {
        return get_object_vars(new static());
    }
}
