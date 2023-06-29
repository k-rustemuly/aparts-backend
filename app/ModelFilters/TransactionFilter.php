<?php

namespace App\ModelFilters;

use App\Traits\OrderByTrait;
use App\Traits\SearchTrait;
use EloquentFilter\ModelFilter;

class TransactionFilter extends ModelFilter
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
        'id',
        'sum',
    ];

    public function status($id)
    {
        return $this->where('status_id', $id);
    }

    public function operationType($id)
    {
        return $this->where('operation_type_id', $id);
    }

    public function client($id)
    {
        return $this->where('client_id', $id);
    }
}
