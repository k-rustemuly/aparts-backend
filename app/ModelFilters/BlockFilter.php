<?php

namespace App\ModelFilters;

use App\Traits\OrderByTrait;
use App\Traits\SearchTrait;
use EloquentFilter\ModelFilter;

class BlockFilter extends ModelFilter
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
        'name',
        'cadastral_number',
        'start',
        'end',
        'storeys_number'
    ];

}
