<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Storeroom extends Model
{
    use HasFactory, Filterable;

    protected $with = ['status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object_id',
        'block_id',
        'name',
        'area',
    ];

    public function status()
    {
        return $this->belongsTo(StoreroomStatus::class);
    }

    public function scopeByBlock(Builder $query, int $blockId): void
    {
        $query->where('block_id', $blockId);
    }

    public static function generateAndSave(int $objectId, int $blockId, int $count, float $area): bool
    {
        $lastEntry = self::where('block_id', $blockId)
            ->orderBy('number', 'desc')
            ->first();

        $startNumber = $lastEntry ? $lastEntry->number + 1 : 1;
        $storeroomEntries = [];

        $now = now();
        for ($i = $startNumber; $i <= ($startNumber + $count - 1); $i++) {
            $storeroomEntries[] = [
                'object_id' => $objectId,
                'block_id' => $blockId,
                'number' => $i,
                'area' => $area,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        return (bool) self::insert($storeroomEntries) > 0;
    }

    public function object()
    {
        return $this->belongsTo(Objects::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public static function getAll($input)
    {
        return self::with([
                            'object',
                            'block'
                        ])
                        ->filter($input);
    }
}
