<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FlatBooking extends Model
{
    use HasFactory;

    protected $with = [
        'client',
        'transaction',
        'bank',
        'employee'
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
        'client_id',
        'transaction_id',
        'bank_id',
        'mortgage_sum',
        'trade_in_sum',
        'installment_plan_sum',
        'cash_sum',
        'employee_id',
        'price',
        'sum',
        'comment'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($flatBooking) {
            $flat = Flat::find($flatBooking->flat_id);
            if($flat->isApprovedToBook())
            {
                $flatBooking->employee_id = Auth::user()->id;
            }
            else {
                return false;
            }
        });

        static::created(function ($flatBooking) {
            Flat::find($flatBooking->flat_id)->reserve();
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public static function getByFlatId($flatId)
    {
        return self::where('flat_id', $flatId)->first();
    }
}
