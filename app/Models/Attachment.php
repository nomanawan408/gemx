<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'passport_cnic_file',
        'personal_photo',
        'company_catalogue',
        'bank_statement',
        'business_card',
        'company_certificate',
        'chamber_association_certificate',
        'company_registration_number',
        'company_logo',
        'pay_order_draft_no',
        'pay_order_amount',
        'pay_order_date',
        'pay_order_bank_name',
        'pay_order_image'
    ];}
