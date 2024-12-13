<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    //
    protected $fillable = [
            'user_id',
            'stall_interest',
            'product_display',
            'product_display_gems_minerals',
            'booth_type',
            'booth_size'
        ];
    
}
