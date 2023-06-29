<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommercialPremiseStatus extends LocalizableModel
{
    use HasFactory;

    /**
     * Localized attributes.
     *
     * @var array
     */
    protected $localizable = ['name'];

}
