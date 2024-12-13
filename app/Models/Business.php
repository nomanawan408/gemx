<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    protected $fillable = [
        'user_id',             // Add this line
        'company_name',
        'address',
        'company_phone',
        'company_mobile',
        'position',
        'main_export_items',
        'main_export_countries',
        'main_import_countries',
        'annual_turnover',
        'annual_import_export',
    ];

    // make relation with user 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
