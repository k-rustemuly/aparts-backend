<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Parking extends Model
{
    use HasFactory, Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parking';

    protected $with = ['status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object_id',
        'name',
    ];

    public function status()
    {
        return $this->belongsTo(ParkingStatus::class);
    }

    public function scopeByObject(Builder $query, int $object_id): void
    {
        $query->where('object_id', $object_id);
    }

    public static function generateAndSave(int $object_id, int $count): bool
    {
        $lastEntry = self::where('object_id', $object_id)
            ->orderBy('number', 'desc')
            ->first();

        $startNumber = $lastEntry ? $lastEntry->number + 1 : 1;
        $parkingEntries = [];

        $now = now();
        for ($i = $startNumber; $i <= ($startNumber + $count - 1); $i++) {
            $parkingEntries[] = [
                'object_id' => $object_id,
                'number' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        return (bool) self::insert($parkingEntries) > 0;
    }

    public function object()
    {
        return $this->belongsTo(Objects::class);
    }

    public static function getAll($input)
    {
        return self::with(['object'])->filter($input);
    }
}
