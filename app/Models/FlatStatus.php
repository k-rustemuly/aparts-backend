<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlatStatus extends LocalizableModel
{
    use HasFactory;

    const ON_SALE = 1;
    const RESERVED = 2;

    protected $localizable = ['name'];
}
