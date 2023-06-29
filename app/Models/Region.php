<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends LocalizableModel
{
    use HasFactory;

    protected $localizable = ['name'];
}
