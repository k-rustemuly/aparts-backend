<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Block extends Model
{
    use HasFactory, Filterable;

    protected $with = ['heatingType'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object_id',
        'name',
        'cadastral_number',
        'start',
        'end',
        'storeys_number',
        'heating_type_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start' => 'datetime:Y-m-d',
        'end' => 'datetime:Y-m-d',
    ];

    public function heatingType()
    {
        return $this->belongsTo(HeatingType::class);
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = \DateTime::createFromFormat('d.m.Y', $value)->format('Y-m-d');
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = \DateTime::createFromFormat('d.m.Y', $value)->format('Y-m-d');
    }

    public function scopeByObject(Builder $query, int $objectId): void
    {
        $query->where('object_id', $objectId);
    }
}
