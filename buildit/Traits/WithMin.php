<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithMin
{
    public int $min = 0;

    public function min(int $min = 0): static
    {
        $this->min = $min;

        return $this;
    }

}
