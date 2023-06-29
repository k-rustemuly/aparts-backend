<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreroomStatus extends LocalizableModel
{
    use HasFactory;

    protected $localizable = ['name'];
}
