<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Traits\Makeable;
use Buildit\Traits\WithKey;
use Buildit\Traits\WithLabel;
use Buildit\Traits\WithTooltip;
use Buildit\Traits\WithType;

abstract class ViewElement
{
    use Makeable;
    use WithKey;
    use WithLabel;
    use WithType;
    use WithTooltip;

    final public function __construct(
        string $key = null,
        string $label = null,
        ?string $tooltip = null
    ) {
        $this->key($key);
        if($label === null) $label = $key;
        $this->setLabel(__($label));
        $this->tooltip(__($tooltip));
        $this->setType($this->type ?? (string) str(class_basename($this))->lower());
    }

}
