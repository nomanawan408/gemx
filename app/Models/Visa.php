<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    // make relation wit user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
