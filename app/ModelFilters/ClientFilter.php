<?php

namespace App\ModelFilters;

use App\Traits\OrderByTrait;
use App\Traits\SearchTrait;
use EloquentFilter\ModelFilter;

class ClientFilter extends ModelFilter
{
    use OrderByTrait, SearchTrait;

    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    /**
     *
     * @var array
     */
    public $columnsToSearch = [
        'iin',
        'phone_number',
        'surname',
        'name',
        'patronymic'
    ];
}
