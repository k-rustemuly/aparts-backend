<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Flat extends Model
{
    use HasFactory, Filterable;

    protected $with = [
        'finishingStatus',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object_id',
        'block_id',
        'floor',
        'number',
        'area',
        'ceiling_height',
        'room',
        'status_id',
        'finishing_status_id',
        'price'
    ];

    public function scopeByBlock(Builder $query, int $blockId): void
    {
        $query->where('block_id', $blockId);
    }

    public function finishingStatus()
    {
        return $this->belongsTo(FinishingStatus::class);
    }

    public function object()
    {
        return $this->belongsTo(Objects::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function status()
    {
        return $this->belongsTo(FlatStatus::class);
    }

    public function isApprovedToBook()
    {
        return $this->status_id === FlatStatus::ON_SALE;
    }

    public static function getAll($input)
    {
        return self::with([
                            'object',
                            'block'
                        ])
                        ->filter($input);
    }

    public function reserve()
    {
        $this->status_id = FlatStatus::RESERVED;
        $this->save();
    }
}
