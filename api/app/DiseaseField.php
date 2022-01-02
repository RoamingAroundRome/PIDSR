<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiseaseField extends Model
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
     * The attributes are being casted to a data type.
     * 
     * @var Array
     */
    protected $casts = [
        'choices' => 'json'
    ];
    
    /**
     * This field belongs to a Diease.
     * 
     * @return BelongsTo
     */
    public function disease()
    {
        return $this->belongsTo('App\Disease');
    }
}
