<?php

declare(strict_types=1);

namespace Buildit\Traits;

use Buildit\Helpers\Condition;

trait WithClickable
{
    public bool $clickable = true;

    /**
     * @param Closure|bool|null $condition
     */
    public function clickable($condition = null): static
    {
        $this->clickable = Condition::boolean($condition, true);

        return $this;
    }
}
