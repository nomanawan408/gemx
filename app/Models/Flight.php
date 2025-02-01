<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\UserParticipant;
use App\Models\User;
use App\Models\Participant;

class Flight extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'arrival_date_time',
        'pickup_terminal',
        'dropoff_terminal',
        'flight_no',
        'airline_name',
        'seat_no',
        'no_of_persons',
        'ticket_upload',
        'departure_date_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function participant()
    {
        return $this->hasOne(UserParticipant::class);
    }

}


