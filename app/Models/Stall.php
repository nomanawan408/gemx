<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    //
    protected $fillable = [
            'user_id',
            'stall',
            'stall_products',
            'selectbiz',
            'booth_type',
            'booth_size',
            'other_booth_size',
        ];
   
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    

}
