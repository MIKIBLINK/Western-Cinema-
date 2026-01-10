<?php

namespace App\Models;

use App\Models\Hall;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showtime extends Model
{
    use SoftDeletes;

    protected $fillable = ['movie_id', 'hall_id', 'start_time', 'price'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
