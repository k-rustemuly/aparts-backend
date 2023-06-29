<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Traits\WithActions;
use Buildit\Traits\WithClickable;
use Buildit\Traits\WithContentUrl;
use Buildit\Traits\WithKey;

class Table extends Label
{
    use WithKey, WithContentUrl, WithActions, WithClickable;

    public array $header = [];

    public array $filter = [];

    public function __construct(string $key, ?string $label = null)
    {
        $this->key($key);
        if($label === null) $label = $key;
        parent::__construct($label);
    }

    public function header(array $header): static
    {
        $this->header = $header;

        return $this;
    }

    public function filter(array $filter): static
    {
        $this->filter = $filter;

        return $this;
    }
}
