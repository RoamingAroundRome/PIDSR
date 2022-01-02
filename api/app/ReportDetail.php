<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportDetail extends Model
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
     * A report detail belongs to a case report.
     * 
     * @return BelongsTo
     */
    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
