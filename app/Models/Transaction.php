<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory, Filterable;

    protected $with = [
        'client',
        'operationType',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'operation_type_id',
        'status_id',
        'sum',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($transaction) {
            $user = Auth::user();
            $transaction->employee_id = $user->id;
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function operationType()
    {
        return $this->belongsTo(OperationType::class);
    }

    public function status()
    {
        return $this->belongsTo(TransactionStatus::class);
    }
}
