<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Fields\FormElement;

class Field extends ViewElement
{
    public array $value = [];

    public function value(FormElement $form): static
    {
        $this->value = get_object_vars($form);

        return $this;
    }
}
