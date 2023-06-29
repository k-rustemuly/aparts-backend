<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithType
{
    public ?string $type = null;

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
