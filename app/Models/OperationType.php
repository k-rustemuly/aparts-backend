<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperationType extends LocalizableModel
{
    use HasFactory;

    const PREPAYMENT = 1;

    protected $localizable = ['name'];
}
