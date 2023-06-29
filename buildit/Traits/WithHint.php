<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithHint
{
    public ?string $hint = null;

    public function hint(string $hint): static
    {
        $this->hint = __($hint);

        return $this;
    }

    public function getHint(): string
    {
        return $this->hint;
    }
}
