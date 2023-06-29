<?php

declare(strict_types=1);

namespace Buildit\Traits;

use UnitEnum;

trait WithMask
{
    public ?string $mask = null;

    public function mask(string|UnitEnum $mask): static
    {
        if($mask instanceof UnitEnum)
        {
            $mask = $mask->value;
        }
        $this->mask = $mask;

        return $this;
    }

}
