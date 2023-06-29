<?php

declare(strict_types=1);

namespace Buildit\Traits;

use Buildit\Helpers\Condition;

trait WithVisibility
{
    public bool $visible = true;

    /**
     * @param Closure|bool|null $condition
     */
    public function invisible($condition = null): static
    {
        $this->visible = Condition::boolean($condition, false);

        return $this;
    }
}
