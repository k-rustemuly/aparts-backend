<?php

declare(strict_types=1);

namespace Buildit\Traits;

use Buildit\Helpers\Condition;

trait WithSearchable
{
    public bool $searchable = false;

    /**
     * @param Closure|bool|null $condition
     */
    public function searchable($condition = null): static
    {
        $this->searchable = Condition::boolean($condition, true);

        return $this;
    }
}
