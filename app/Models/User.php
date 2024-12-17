<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'father_first_name',
        'father_last_name',
        'gender',
        'country',
        'address',
        'city',
        'nationality',
        'profession',
        'mobile',
        'phone',
        'fb_url',
        'whatsapp',
        'linkedin',
        'telegram',
        'instagram',
        'wechat',
        'imo',
        'cnic_passport_no',
        'passport_type',
        'date_of_issue',
        'date_of_expiry',
        'declaration',
        'provider_id',
        'provider',
        'access_token',
        'invited_way',
        'avatar'    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
         * Get the business associated with the user.
         */

         public function business()
         {
             return $this->hasOne(Business::class, 'user_id', 'id');
         }
    
        /**
         * Get the user participants associated with the user.
         */
        public function userParticipants()
        {
            return $this->hasMany(UserParticipant::class);
        }
    
        /**
         * Get the exhibitions associated with the user.
         */
        public function exhibitions()
        {
            return $this->hasMany(Exhibition::class);
        }
    
        /**
         * Get the stalls associated with the user.
         */
        public function stalls()
        {
            return $this->hasMany(Stall::class);
        }
    
    
}
