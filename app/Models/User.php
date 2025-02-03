<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\UserParticipant;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($user) {
            if (empty($user->uuid)) {
                $user->uuid = (string) Str::uuid();
            }
        });
    }

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
        'avatar',
        'status',
        'is_onspot',    
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
    
        public function participant()
        {
            // hasOne( RelatedModel::class, 'foreign_key', 'local_key' )
            return $this->hasOne(UserParticipant::class, 'user_id', 'id');
        }
        
        /**
         * Get the exhibitions associated with the user.
         */
        public function exhibition()
        {
            return $this->hasOne(Exhibition::class, 'user_id', 'id');
        }
    
        /**
         * Get the stalls associated with the user.
         */
        public function stall()
        {
            return $this->hasOne(Stall::class, 'user_id', 'id');
        }
    
        public function attachment()
        {
            return $this->hasOne(Attachment::class, 'user_id', 'id');
        }
        
    
        /**
         * Get all of the flights for the User
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function flight()
        {
            return $this->hasOne(Flight::class);
        }
        
                
        // relation for visa
        public function visa()
        {
            return $this->hasOne(Visa::class);
        }

        public function accommodation()
        {
            return $this->hasOne(Accommodation::class);
        }
}
