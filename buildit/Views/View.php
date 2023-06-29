<?php

declare(strict_types=1);

namespace Buildit\Views;

use Buildit\Traits\Makeable;
use Buildit\Traits\WithLabel;
use Buildit\Traits\WithType;

abstract class View
{
    use Makeable;
    use WithLabel;
    use WithType;

    final public function __construct(
        $label = null,
    ) {
        $this->setLabel((string) $label);
        $this->setType($this->type ?? (string) str(class_basename($this))->lower());
    }

}
