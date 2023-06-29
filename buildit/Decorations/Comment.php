<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Traits\WithActions;
use Buildit\Traits\WithContentUrl;
use Buildit\Traits\WithKey;

class Comment extends Label
{
    use WithKey, WithContentUrl, WithActions;

    public function __construct(string $key, ?string $label = null)
    {
        $this->key($key);
        if($label === null) $label = $key;
        parent::__construct($label);
    }

}
