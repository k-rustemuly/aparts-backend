<?php

declare(strict_types=1);

namespace Buildit\Traits;

use Buildit\Helpers\Condition;

trait WithPicker
{
    public bool $pickerable = false;

    /**
     * @param Closure|bool|null $condition
     */
    public function pickerable($condition = null): static
    {
        $this->pickerable = Condition::boolean($condition, true);

        return $this;
    }
}
