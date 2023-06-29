<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Objects extends LocalizableModel
{
    use HasFactory, Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'objects';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'region',
        'city',
        'status',
        'class',
        'technology'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'region_id',
        'city_id',
        'name_kk',
        'name_ru',
        'description_kk',
        'description_ru',
        'class_id',
        'technology_id'
    ];

    protected $localizable = [
        'name',
        'description'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function status()
    {
        return $this->belongsTo(ObjectStatus::class);
    }

    public function class()
    {
        return $this->belongsTo(ObjectClass::class);
    }

    public function technology()
    {
        return $this->belongsTo(ConstructionTechnology::class);
    }

}
