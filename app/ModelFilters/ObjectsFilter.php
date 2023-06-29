<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use App\Traits\OrderByTrait;
use App\Traits\SearchTrait;

class ObjectsFilter extends ModelFilter
{
    use OrderByTrait, SearchTrait;
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public $columnsToSearch = ['name_kk', 'name_ru'];

    public function city($ids)
    {
        return $this->whereIn('city_id', $ids);
    }

    public function class($ids)
    {
        return $this->whereIn('class_id', $ids);
    }

    public function technology($ids)
    {
        return $this->whereIn('technology_id', $ids);
    }
}
