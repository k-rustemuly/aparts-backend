<?php

declare(strict_types=1);

namespace Buildit\Fields;

use Buildit\Enum\VisibilityType;
use Buildit\Helpers\Condition;

abstract class Field extends FormElement
{
    public bool $required = false;

    public $value = null;

    public VisibilityType $visibility = VisibilityType::VISIBLE;

    /**
     * @param Closure|bool|null $condition
     */
    public function required($condition = null): static
    {
        $this->required = Condition::boolean($condition, true);

        return $this;
    }

    public function value($value = null): static
    {
        $this->value = $value;

        return $this;
    }

    public function visibility(VisibilityType $visibility):static
    {
        $this->visibility = $visibility;

        return $this;
    }
}
