<?php

namespace App\ModelFilters;

use App\Traits\OrderByTrait;
use App\Traits\SearchTrait;
use EloquentFilter\ModelFilter;

class FlatFilter extends ModelFilter
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
        'number',
        'area',
        'floor',
        'ceiling_height',
        'room',
        'price'
    ];

    public function finishingStatuses($ids)
    {
        return $this->whereIn('finishing_status_id', $ids);
    }

    public function statuses($ids)
    {
        return $this->whereIn('status_id', $ids);
    }

    public function objects($ids)
    {
        return $this->whereIn('object_id', $ids);
    }

    public function fromFloor($floor)
    {
        return $this->where('floor', '>=', $floor);
    }

    public function toFloor($floor)
    {
        return $this->where('floor', '<=', $floor);
    }

    public function fromRoom($room)
    {
        return $this->where('room', '>=', $room);
    }

    public function toRoom($room)
    {
        return $this->where('room', '<=', $room);
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
