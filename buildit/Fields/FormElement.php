<?php

declare(strict_types=1);

namespace Buildit\Fields;

use Buildit\Traits\Makeable;
use Buildit\Traits\Renderable;
use Buildit\Traits\WithHint;
use Buildit\Traits\WithKey;
use Buildit\Traits\WithLabel;
use Buildit\Traits\WithType;
use Illuminate\Support\Traits\Conditionable;

abstract class FormElement
{
    use Makeable;
    use WithKey;
    use WithLabel;
    use WithHint;
    use Conditionable;
    use Renderable;
    use WithType;

    final public function __construct(
        string $key,
        ?string $label = null
    ) {
        $this->key($key);
        if($label === null) $label = $key;
        $this->setLabel(__($label));
        $this->setType($this->type ?? (string) str(class_basename($this))->lower());
    }

}
