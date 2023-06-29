<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithItems
{
    public array $items = [];

    public function setItems(array $items): static
    {
        $this->items = $items;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem($item, int $index = -1): static
    {
        if($index >= 0)
            array_splice($this->items, $index-1, 0, [$item]);
        else
            $this->items =  array_merge($this->items, [$item]);

        return $this;
    }
}
