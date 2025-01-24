<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exhibition extends Model
{
    //
    use HasFactory;

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
