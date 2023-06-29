<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectStatus extends LocalizableModel
{
    use HasFactory;

    protected $localizable = ['name'];
}
