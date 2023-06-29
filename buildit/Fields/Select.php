<?php

declare(strict_types=1);

namespace Buildit\Fields;

class Select extends Field
{
    public int $selectCount = 1;

    public function count(int $selectCount): static
    {
        $this->selectCount = $selectCount;

        return $this;
    }
}
