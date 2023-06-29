<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingStatus extends LocalizableModel
{
    use HasFactory;

    protected $localizable = ['name'];
}
