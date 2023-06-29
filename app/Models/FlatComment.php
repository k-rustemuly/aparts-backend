<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FlatComment extends Model
{
    use HasFactory, Filterable;

    protected $with = [
        'user',
        'role',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object_id',
        'block_id',
        'flat_id',
        'user_id',
        'role_id',
        'comment',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($flatComment) {
            $user = Auth::user();
            $flatComment->user_id = $user->id;
            $flatComment->role_id = $user->role_id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function list(int $flatId, $input)
    {
        return self::filter($input)
                    ->where('flat_id', $flatId)
                    ->orderBy('created_at', 'desc');
    }
}
