<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Regex\Regex;

class Disease extends Model
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
     * The related models to be softly deleted when
     * this parent model gets softly deleted.
     * 
     * @var Array
     */
    protected $softCascade = [
        'fields'
    ];
    
    /**
     * There are 2 categories of diseases.
     * 
     * @var Array
     */
    private $categories = [
        'immediately notifiable',
        'weekly notifiable',
    ];

    /**
     * The category for immediately notifiable diseases.
     * 
     * @var Array
     */
    private $immediately = [
        'Adverse Effect Following Immunization (AEFI)',
        'Acute Flaccid Paralysis (AFP)',
        'Anthrax',
        'Hand, Foot and Mouth Disease',
        'Measles',
        'Meningococcal Disease',
        'Neonatal Tetanus',
        'Rabies',
        'Paralytic Shellfish Poisioning',
    ];
  
    /**
     * The category for weekly notifiable diseases.
     * 
     * @var Array
     */
    private $weekly = [
        'Acute Bloody Diarrhea',
        'Acute Encephalitis Syndrome',
        'Acute Hemorrhagic Fever Syndrome',
        'Acute Meningitis/Encephalitis Surveillance (AMES)',
        'Bacterial Meningitis',
        'Chikungunya Virus Disease',
        'Cholera',
        'Dengue Fever',
        'Diphtheria',
        'Hepatitis',
        'Influenza',
        'Leptospirosis',
        'Malaria',
        'Non-Neonatal Tetanus',
        'Petussis',
        'Rotavirus Surveillance',
        'Typhoid and Paratyphoid Fever'
    ];

    /**
     * Gets all of the disease categories.
     * 
     * @return Array
     */
    public function categories()
    {
        return $this->categories;
    }

    /**
     * Gets all of the immediately notifiable diseases.
     * 
     * @return Array
     */
    public function getImmediatelyNotifiable()
    {
        return $this->immediately;
    }

    /**
     * Gets all of the weekly notifiable diseases.
     * 
     * @return Array
     */
    public function getWeeklyNotifiable()
    {
        return $this->weekly;
    }

    /**
     * A disease has many case reports.
     * 
     * @return HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }
    
    /**
     * This disease contains many fields.
     * 
     * @return HasMany
     */
    public function fields()
    {
        return $this->hasMany('App\DiseaseField');
    }

    /**
     * Groups the fields in section.
     * 
     * @return Object
     */
    public function groupedFields()
    {
        return $this->fields->groupBy('section');
    }

    /**
     * Maps the disease data to contain the grouped fields.
     * 
     * @return Collection
     */
    public function mappedData()
    {
        return (object) [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'slug' => $this->slug,
            'alert_threshold' => $this->alert_threshold,
            'epidemic_threshold' => $this->epidemic_threshold,
            'fields' => $this->groupedFields(),
        ];
    }

    /**
     * Checks if the disease had peaked its alert threshold.
     * 
     * @return Boolean
     */
    public function hasPeakedAlertThreshold()
    {
        if ($this->isWeeklyNotifiable()) {
            return $this->alert_threshold == $this->getCurrentWeekCaseReports()->count();
        }

        else if ($this->isImmediatelyNotifiable()) {
            return $this->alert_threshold == $this->getCurrentDateCaseReports()->count();
        }
    }

    /**
     * Checks if disease category is weekly notifiable.
     * 
     * @return Boolean
     */
    public function isWeeklyNotifiable()
    {
        return Regex::match('/weekly/', $this->category)->hasMatch();
    }

    /**
     * Checks if disease category is immediately notifiable.
     * 
     * @return Boolean
     */
    public function isImmediatelyNotifiable()
    {
        return Regex::match('/immediately/', $this->category)->hasMatch();
    }

    /**
     * Get current week case reports.
     * 
     * @return Array
     */
    public function getCurrentWeekCaseReports()
    {
        return $this->reports
            ->where('created_at', '>=', now()->startOfWeek())
            ->where('created_at', '<=', now()->endOfWeek());
    }

    /**
     * Get current date case reports.
     * 
     * @return Array
     */
    public function getCurrentDateCaseReports()
    {
        return $this->reports
            ->where('created_at', '>=', now()->startOfDay())
            ->where('created_at', '<=', now()->endOfDay());
    }
}
