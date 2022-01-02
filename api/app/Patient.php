<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    /**
     * The attributes that are not mass assignable.
     * 
     * @var Array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Cascade deletes the other related models.
     * 
     * @var Array
     */
    protected $softCascade = [
        'address',
        'report'
    ];
    
    /**
     * The attributes that are casted to a data-type.
     * 
     * @var Array
     */
    protected $casts = [
        'is_4P_member' => 'boolean',
        'inter_local_health_zone' => 'boolean'
    ];
    
    /**
     * Gets the address of patient.
     * 
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne('App\Address', 'addressable');
    }

    /**
     * A patient is the subject of the case report.
     * 
     * @return HasMany
     */
    public function report()
    {
        return $this->hasOne('App\Report');
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
     * The patient's outcome from a case report.
     * 
     * @return String
     */
    public function getOutcome()
    {
        if ( !isset($this->report) ) {
            return "Unconfirmed (U)";
        }
        
        return $this->report->getOutcome();
    }
}
