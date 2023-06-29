<?php

declare(strict_types=1);

namespace Buildit\Fields;

use Buildit\Traits\WithContentUrl;
use Buildit\Traits\WithSearchable;

class Reference extends Select
{
    use WithContentUrl, WithSearchable;

    public ?string $linked = null;

    public function linked(?string $linked = null): static
    {
        $this->linked = $linked;

        return $this;
    }
}
