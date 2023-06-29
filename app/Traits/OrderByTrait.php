<?php

declare(strict_types=1);

namespace App\Traits;

trait OrderByTrait
{
    public function orderBy($orderBy)
    {
        return $this->query->orderBy($orderBy, $this->input('order', 'DESC'));
    }
}
