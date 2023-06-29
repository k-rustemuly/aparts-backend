<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Traits\WithKey;

class DataList extends Label
{
    use WithKey;

    public function __construct(string $key, ?string $label = null, array $items = array())
    {
        $this->key($key);
        if($label === null) $label = $key;
        parent::__construct($label, $items);
    }
}
