<?php

declare(strict_types=1);

namespace Buildit\Traits;

use InvalidArgumentException;

trait WithColumnSpan
{
    public int $columnSpan = 12;

    public function columnSpan(int $columnSpan): static
    {
        if ($columnSpan <= 0 || $columnSpan > 12) {
            throw new InvalidArgumentException(
                'columnSpan must be greater than zero and less than 12'
            );
        }

        $this->columnSpan = $columnSpan;

        return $this;
    }
}
