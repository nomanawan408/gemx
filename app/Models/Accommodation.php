<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accommodation extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hotel_name',
        'room_no',
        'check_in_time',
        'description',
        'accommodation_pass',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
