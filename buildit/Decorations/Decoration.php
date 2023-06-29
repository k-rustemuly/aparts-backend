<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Traits\Makeable;
use Buildit\Traits\WithItems;
use Buildit\Traits\WithLabel;
use Buildit\Traits\WithType;

abstract class Decoration
{
    use Makeable;
    use WithType;
    use WithLabel;
    use WithItems;

    protected $whenCondition;

    public function __construct(array $items = [])
    {
        $this->setType((string) str(class_basename($this))->lower());
        $this->setItems($items);
    }

    public function when($condition, $callback = null)
    {
        $this->whenCondition = $condition;

        if ($callback && $this->whenCondition) {
            $callback($this);
        }

        return $this;
    }
}
