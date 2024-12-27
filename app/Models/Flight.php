<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    //
    protected $fillable = [
        'user_id',
        'flight_arrival_date_time',
        'pickup_terminal',
        'dropoff_terminal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}


