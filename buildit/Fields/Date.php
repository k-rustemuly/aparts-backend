<?php

declare(strict_types=1);

namespace Buildit\Fields;

use Buildit\Traits\WithPicker;

class Date extends Field
{
    use WithPicker;

    public string $format = '##.##.####';

    public function format(string $format): static
    {
        $this->format = $format;

        return $this;
    }
}
