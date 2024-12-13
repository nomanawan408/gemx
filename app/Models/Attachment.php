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
        'company_registration_copy',
        'chamber_association_certificate',
        'company_catalogue',
        'passport_cnic_file',
        'bank_statement',
        'pay_order_draft_no',
        'pay_order_amount',
        'pay_order_date',
        'pay_order_bank_name',
        'pay_order_image'
    ];}
