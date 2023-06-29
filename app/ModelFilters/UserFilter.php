<?php

namespace App\ModelFilters;

use App\Traits\OrderByTrait;
use App\Traits\SearchTrait;
use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
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
    public $columnsToSearch = ['name', 'email'];

    public function roles($ids)
    {
        return $this->whereIn('role_id', $ids);
    }

    public function name($name)
    {
        return $this->where('name', 'LIKE', "%$name%");
    }

    public function email($email)
    {
        return $this->where('email', 'LIKE', "%$email%");
    }
}
