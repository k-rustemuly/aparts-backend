<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Helpers\Condition;
use Buildit\Traits\Makeable;
use Buildit\Traits\WithKey;
use Buildit\Traits\WithType;
use Buildit\Traits\WithLabel;
use Buildit\Traits\WithSearchable;
use Buildit\Traits\WithVisibility;

class Raw
{
    use Makeable;
    use WithType;
    use WithLabel;
    use WithVisibility;
    use WithSearchable;
    use WithKey;

    public bool $sortable = false;

    public function __construct(string $key, ?string $label = null)
    {
        $this->key($key);
        if($label === null) $label = $key;
        $this->setType((string) str(class_basename($this))->lower());
        $this->setLabel(__($label));
    }

    public function render(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param Closure|bool|null $condition
     */
    public function sortable($condition = null): static
    {
        $this->sortable = Condition::boolean($condition, true);

        return $this;
    }
}
