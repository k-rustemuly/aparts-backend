<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithLabel
{
    public ?string $label = '';

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
