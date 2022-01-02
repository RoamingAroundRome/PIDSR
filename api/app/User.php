<?php

namespace App;

use App\Notifications\ImmediatelyNotifiable;
use App\Notifications\WeeklyNotifiable;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes, SoftCascadeTrait, HasRoles;

    /**
     * Tables that have cascading delete.
     * 
     * @var array
     */
    protected $softCascade = [
        // 
    ];
    
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Generates a password in random String.
     * 
     * @return String
     */
    public function generatePassword()
    {
        return Str::random(16);
    }

    /**
     * Gets the address of user.
     * 
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne('App\Address', 'addressable');
    }

    /**
     * Cases that this officer has reported.
     * 
     * @var HasMany
     */
    public function cases_reported()
    {
        return $this->hasMany('App\Report', 'investigator_id');
    }
    
    /**
     * A user has to be an Officer that belongs to a DRU.
     * 
     * @return BelongsTo
     */
    public function dru()
    {
        return $this->belongsTo('App\DRU', 'dru_id')->withDefault([
            'name' => 'Not specified',
            'type' => 'Not specified',
            'national_sentinel_site' => false,
            'philmis_site' => false,
            'address' => [
                'region' => 'Not specified',
                'province' => 'Not specified',
                'municity' => 'Not specified',
                'barangay' => 'Not specified',
                'street' => 'Not specified',
                'district' => 'Not specified',
            ]
        ]);
    }

    /**
     * The patient's fullname.
     * 
     * @return String
     */
    public function getFullName()
    {
        return "$this->last_name, $this->first_name $this->middle_name";
    }

    /**
     * Takes the first role the user has.
     * 
     * @return String
     */
    public function getFirstRole()
    {
        $roles = $this->getRoleNames()->all();
        
        return array_shift($roles);
    }
    
    /**
     * Sets the role of a user.
     * 
     * @return Boolean
     */
    public function setRole($data = null)
    {
        $role = Role::where('name', $data)->first();
        
        return $this->assignRole($role);
    }

    /**
     * Notify all users for a weekly notifiable disease reached 
     * the threshold limit for the current week.
     * 
     * @return Object $disease
     * @return Boolean
     */
    protected function notifyWeeklyAll($disease)
    {
        if ( !isset($disease) ) {
            return false;
        }
        
        foreach ($this->all() as $user) {
            $user->notify(new WeeklyNotifiable($disease));
        }

        return true;
    }

    /**
     * Notify all users for a immediately notifiable disease reached 
     * the threshold limit for the current week.
     * 
     * @return Object $disease
     * @return Boolean
     */
    protected function notifyImmediatelyAll($disease)
    {
        if ( !isset($disease) ) {
            return false;
        }
        
        foreach ($this->all() as $user) {
            $user->notify(new ImmediatelyNotifiable($disease));
        }

        return true;
    }
}
