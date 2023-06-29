<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionStatus extends LocalizableModel
{

    const NOT_PAID = 1;
    const PAID = 2;

    use HasFactory;

    protected $localizable = ['name'];

}
