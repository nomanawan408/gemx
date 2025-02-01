<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class UserParticipant extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'father_firstname',
        'father_lastname',
        'gender',
        'phone',
        'mobile',
        'whatsapp',
        'email',
        'facebook',
        'linkedin',
        'instagram',
        'telegram',
        'wechat',
        'imo',
        'passport_no',
        'passport_issue',
        'passport_expiry',
        'passport_type',
        'passport_url',
        'previous_trips',
    ];

    public function user()
    {
        // belongsTo( RelatedModel::class, 'foreign_key', 'owner_key' )
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
