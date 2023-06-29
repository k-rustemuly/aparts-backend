<?php

namespace App\ModelFilters;

use App\Traits\OrderByTrait;
use App\Traits\SearchTrait;
use EloquentFilter\ModelFilter;

class StoreroomFilter extends ModelFilter
{
    use OrderByTrait, SearchTrait;
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public $columnsToSearch = [
        'number', 'area'
    ];

    public function statuses($ids)
    {
        return $this->whereIn('status_id', $ids);
    }

    public function objects($ids)
    {
        return $this->whereIn('object_id', $ids);
    }

    public function fromArea($area)
    {
        return $this->where('area', '>=', $area);
    }

    public function toArea($area)
    {
        return $this->where('area', '<=', $area);
    }
}
