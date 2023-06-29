<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectClass extends LocalizableModel
{
    use HasFactory;

    protected $localizable = [
        'name',
        'description'
    ];
}

