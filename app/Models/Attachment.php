<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'business_card',
        'company_logo',
        'company_catalogue',
        'company_certificate',
        'chamber_association_certificate',
        'personal_photo',
        'passport_cnic_file',
        'bank_statement',
        'company_registration_number',
        'pay_order_draft_no',
        'pay_order_amount',
        'pay_order_date',
        'pay_order_bank_name',
        'pay_order_image',
        'recommendation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    }
