<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithTooltip
{
    public ?string $tooltip = '';

    public function tooltip(?string $tooltip): static
    {
        $this->tooltip = $tooltip;

        return $this;
    }
}
