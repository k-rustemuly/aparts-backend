<?php

declare(strict_types=1);

namespace Buildit\Traits;
use Buildit\Helpers\Condition;

trait WithActions
{
    public array $actions = [];

    public function actions($condition = null, array $actions): static
    {
        if(Condition::boolean($condition, false))
            $this->actions = array_merge($this->actions, $actions);

        return $this;
    }
}
