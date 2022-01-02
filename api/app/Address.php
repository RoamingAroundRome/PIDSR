<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    
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
     * An address belongs to many types of Owner.
     * # User, DRU, Patient
     * 
     * @return MorphTo
     */
    public function addressable()
    {
        return $this->morphTo()->withDefault([
            'region' => 'Not specified',
            'province' => 'Not specified',
            'municity' => 'Not specified',
            'barangay' => 'Not specified',
            'street' => 'Not specified',
            'district' => 'Not specified',
        ]);
    }
}
