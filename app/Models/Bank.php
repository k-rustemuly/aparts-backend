<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends LocalizableModel
{
    use HasFactory, Filterable;

    /**
     * Localized attributes.
     *
     * @var array
     */
    protected $localizable = ['name'];
}
