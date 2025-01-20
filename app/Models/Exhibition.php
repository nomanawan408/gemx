<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    //
    protected $fillable = [
            'user_id',
            'exhibition_name',
            'exhibition_date',
            'type',
            'country',
        ];
    
    
    // make relation with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
