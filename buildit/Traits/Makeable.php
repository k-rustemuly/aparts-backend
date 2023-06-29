<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait Makeable
{
    public static function make(...$arguments): static
    {
        $static = new static(...$arguments);
        $static->afterMake();

        return $static;
    }

    protected function afterMake(): void
    {
        // Resolve
    }
}
