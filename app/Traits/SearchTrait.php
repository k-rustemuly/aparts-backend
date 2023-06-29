<?php

declare(strict_types=1);

namespace App\Traits;

trait SearchTrait
{
    public function search($search)
    {
        $columns = $this->columnsToSearch;
        return $this->query->where(function($query) use ($columns, $search){
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%'.$search.'%');
            }
        });
    }
}
