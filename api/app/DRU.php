<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DRU extends Model
{
    use SoftDeletes, SoftCascadeTrait;
    
    /**
     * The relationships that should always be loaded.
     *
     * @var Array
     */
    protected $with = [
        'officer'
    ];

    /**
     * The related models that gets cascaded on delete.
     * 
     * @var Array
     */
    protected $softCascade = [
        // 
    ];
    
    /**
     * The name of the table in DB.
     * 
     * @var String
     */
    protected $table = 'drus';
    
    /**
     * Fields that are not mass assignable.
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
     * Fields that are casted as a custom data-type.
     * 
     * @var Array
     */
    protected $casts = [
        'national_sentinel_site' => 'boolean',
        'philmis_site' => 'boolean'
    ];

    /**
     * A DRU has many officers.
     * These officers may be replaced.
     * 
     * @return HasOne
     */
    public function officer()
    {
        return $this->hasOne('App\User', 'dru_id')->withDefault([
            'investigator' => 'Not specified',
            'phone_number' => 'Not specified'
        ]);
    }

    /**
     * A DRU has an address.
     * 
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Get all latest entries of a DRU.
     * 
     * @return Collection
     */
    public function latestEntries()
    {
        if ( !isset($this->officer) ) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'latest_entry' => null, 
                'cases' => [],
            ];
        }

        $latestEntry = $this->officer->cases_reported()->latest()->first();
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'latest_entry' => $latestEntry->created_at ?? null, 
            'cases' => $this->officer->cases_reported()->latest()->get(),
        ];
    }
}
