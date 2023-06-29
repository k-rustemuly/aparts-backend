<?php

declare(strict_types=1);

namespace Buildit\Decorations;

abstract class Label extends Decoration
{

    public function __construct($label, array $items = [])
    {
        parent::__construct($items);
        $this->setLabel(__((string) $label));
    }

}
