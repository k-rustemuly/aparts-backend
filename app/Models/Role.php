<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Role extends LocalizableModel
{
    use HasFactory;

    protected $localizable = [
        'name',
    ];

    public function scopeReference(Builder $query): void
    {
        $query->when(Auth::user()->isAdmin(), function ($q){
            return $q->where('id', '!=', 1)->where('id', '!=', 3);
        });
    }
}
