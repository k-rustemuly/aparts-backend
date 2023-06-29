<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithKey
{
    public ?string $key = null;

    public function key(?string $key): static
    {
        $this->key = $key;

        return $this;
    }

}
