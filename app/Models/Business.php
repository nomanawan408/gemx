<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'company_email',
        'position',
        'company_phone',
        'company_mobile',
        'website_url',
        'company_registered_number',
        'vat_tax_number',
        'chamber_association_member',
        'nature_of_business',
        'type_of_business',
        'main_business_items',
        'main_import_items',
        'main_export_items',
        'main_import_countries',
        'main_export_countries',
        'annual_turnover',
        'annual_import_export',
        'national_sale',
        'annual_import_from_pak',
        'product_interest',
        'amount',
        'ntn',
        'gst',
        'chamber_association_no'
    ];
    // make relation with user 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
