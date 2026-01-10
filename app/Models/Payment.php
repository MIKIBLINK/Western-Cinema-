<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_id',
        'amount',
        'method',
        'status',
        'transaction_ref',
    ];

     public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
