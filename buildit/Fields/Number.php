<?php

declare(strict_types=1);

namespace Buildit\Fields;

use Buildit\Traits\WithMask;
use Buildit\Traits\WithMin;

class Number extends Field
{
    use WithMin, WithMask;

    public ?int $exact_length = null;

    public function exactLength(int $length = 0): static
    {
        $this->exact_length = $length;

        return $this;
    }
}
