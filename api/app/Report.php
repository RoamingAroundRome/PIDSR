<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Regex\Regex;

class Report extends Model
{
    use SoftDeletes, SoftCascadeTrait;
    
    private $questions;
    private $dateOfEntry;
    private $dateOfOnset;
    private $adminToEntry;
    private $onsetToAdmit;
    private $morbidityWeek;
    private $morbidityMonth;
    private $year;

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
     * On delete cascade delete to other related models.
     * 
     * @var Array
     */
    protected $softCascade = [
        'details',
        'morbidity_report',
    ];

    /**
     * Always have related models in all queries.
     * 
     * @var Array
     */
    protected $with = [
        'morbidity_report',
        'patient.address',
        'investigator',
        'report_details',
    ];

    /**
     * A report belongs to a certain disease.
     * 
     * @return BelongsTo
     */
    public function disease()
    {
        return $this->belongsTo('App\Disease');
    }
    
    /**
     * A report contains details, these are the
     * questions & answers of a specific disease.
     * 
     * @return HasMany
     */
    public function report_details()
    {
        return $this->hasMany('App\ReportDetail');
    }

    /**
     * A report has a morbidity report.
     * # meaning: the condition of being diseased.
     * 
     * @return HasOne
     */
    public function morbidity_report()
    {
        return $this->hasOne('App\MorbidityReport')->withDefault([
            'week' => 'Not specified',
            'month' => 'Not specified',
            'year' => 'Not specified',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);
    }

    /**
     * A report has an investigator.
     * 
     * @return BelongsTo
     */
    public function investigator()
    {
        return $this->belongsTo('App\User', 'investigator_id')
        ->withDefault([
            'dru_id' => 'Not specified',
            'avatar' => 'Not specified',
            'first_name' => 'Not specified',
            'middle_name' => 'Not specified',
            'last_name' => 'Not specified',
            'email' => 'Not specified',
            'phone_number' => 'Not specified',
            'date_started' => null,
            'date_ended' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);
    }
    
    /**
     * A case report belongs to a patient.
     * 
     * @return BelongsTo 
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient')
        ->withDefault([
            'patient_no' => 'Not specified',
            'first_name' => 'Not specified',
            'middle_name' => 'Not specified',
            'last_name' => 'Not specified',
            'ethnicity' => 'Not specified',
            'age' => 'Not specified',
            'gender' => 'Not specified',
            'status' => 'Not specified',
            'is_4P_member' => 'Not specified',
            'inter_local_health_zone' => 'Not specified',
            'blood_type' => 'Not specified',
            'rh_type' => 'Not specified',
            'date_of_death' => null,
            'date_of_birth' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);
    }

    /**
     * Scope a query only for disease id.
     * 
     * @param Integer $id
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDiseaseId($query, $id)
    {
        return $query->whereDiseaseId($id);
    }

    /**
     * Scope a query for date range.
     * 
     * @param String $min date
     * @param String $max date
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDateRange($query, $min, $max)
    {
        return $query->where('created_at', '>=', $min)
            ->where('created_at', '<=', $max);
    }

    /**
     * Scope a query only for region.
     * 
     * @param String $region
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegion($query, $region)
    {
        return $query->whereHas('patient.address', function($query) use ($region) {
            $query->where('region', 'LIKE', '%'.$region.'%');
        });
    }

    /**
     * Scope a query only for municity.
     * 
     * @param String $municity
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMunicity($query, $municity)
    {
        return $query->whereHas('patient.address', function($q) use ($municity) {
            $q->Where('municity', 'LIKE', '%'.$municity.'%');
        });
    }

    /**
     * Get the number of cases in the past hour.
     * 
     * @return Integer
     */
    public function getCasesPastHour()
    {
        return $this->where(
            'created_at', '>=', now()->subHour(1))
            ->get()
            ->filter(function($data) {
                if ( auth()->user()->hasRole('officer') ) {
                    return $data->investigator->id == auth()->user()->id;
                }

                return true;
            })->values();
    }

    /**
     * Get the number of cases in the past hour.
     * 
     * @return Integer
     */
    public function getCasesPastWeek()
    {
        return $this->where(
            'created_at', '>=', now()->subWeek(1))
            ->get()
            ->filter(function($data) {
                if ( auth()->user()->hasRole('officer') ) {
                    return $data->investigator->id == auth()->user()->id;
                }

                return true;
            })->values();
    }

    /**
     * Get the number of cases in the past hour.
     * 
     * @return Integer
     */
    public function getCasesPastMonth()
    {
        return $this->where(
            'created_at', '>=', now()->subMonth(1))
            ->get()
            ->filter(function($data) {
                if ( auth()->user()->hasRole('officer') ) {
                    return $data->investigator->id == auth()->user()->id;
                }

                return true;
            })->values();
    }
    
    /**
     * Get the outcome of the case report.
     * 
     * @return Object
     */
    public function getOutcome()
    {
        $outcome = $this->report_details->filter(function ($data) {
            return strtolower($data->question) == 'outcome';
        })->first(); 

        if ( !isset($outcome) ) {
            return "Unconfirmed (U)";
        }

        return $outcome->answer;
    }
    
    /**
     * Get the date admitted from the array of questions.
     * 
     * @param Array $questions
     * @return String
     */
    private function getDateAdmitted()
    {
        $date = null;
        
        foreach($this->questions as $key => $value) {
            $regex = Regex::match('/date admitted/', strtolower($value['question']));
            
            if ($regex->hasMatch()) {
                $date = $value['answer'];
            }
        }

        if ( !isset($date) ) {
            return null;
        }
        
        return Carbon::parse("$date ".now()->format('h:i:s'));
    }

    /**
     * Get date of onset from questions array.
     * 
     * @return String
     */
    private function getDateOfOnset()
    {
        $date = null;
        
        foreach($this->questions as $key => $value) {
            $regex = Regex::match('/date of onset/', strtolower($value['question']));
            
            if ($regex->hasMatch()) {
                $date = $value['answer'];
            }
        }

        if ( !isset($date) ) {
            return null;
        }
        
        return Carbon::parse("$date ".now()->format('h:i:s'));
    }

    /**
     * The date of entry minus date admitted. (in days)
     * 
     * # date of entry is the current date
     * @return Integer
     */
    private function getAdmitToEntry()
    {
        return now()->diffInDays($this->getDateAdmitted());
    }

    /**
     * The date of entry minus date admitted. (in days)
     * 
     * # date of entry is the current date
     * @return Integer
     */
    private function getOnsetToAdmit()
    {
        return now()->diffInDays($this->getDateOfOnset());
    }

    /**
     * Gets the month of the date admitted data.
     * e.g. month 1 to 12
     * returns month 4 as (month 4 is March but returns integer, 4)
     * 
     * @return Integer
     */
    private function getMorbidityMonth()
    {
        return (integer) $this->getDateAdmitted()->format('m');
    }

    /**
     * Gets the week based on the date admitted data.
     * e.g. week 1 to week 52
     * returns week 43 (so returns integer, 43)
     * 
     * @return Integer
     */
    private function getMorbidityWeek()
    {
        return (integer) $this->getDateAdmitted()->format('W');
    }

    /**
     * Gets the year of the date admitted.
     * 
     * @return Integer
     */
    private function getMorbidityYear()
    {
        return $this->getDateAdmitted()->year;
    }
    
    /**
     * Get the patient's age based from birthdate.
     * 
     * @param String $dob date of birth
     * @return Integer
     */
    private function getAge($dob)
    {
        return now()->year - Carbon::parse($dob)->year;
    }
    
    // the age of patient in years
    // date admitted/seen/consulted - date of birth
    private function getAgeYear() 
    {
        // 
    }

    // the age of patient in months
    // date admitted/seen/consulted - date of birth
    private function getAgeMonth()
    {
        // 
    }

    // the age of patient in days
    // date admitted/seen/consulted - date of birth
    private function getAgeDay()
    {
        // 
    }

    /**
     * Handles the alert threshold notification.
     * 
     * @param Object $disease
     * @return Boolean
     */
    private function notify($disease)
    {
        if ($disease->hasPeakedAlertThreshold()) {
            if ($disease->isWeeklyNotifiable()) {
                return User::notifyWeeklyAll($disease);
            }

            else if ($disease->isImmediatelyNotifiable()) {
                return User::notifyImmediatelyAll($disease);
            }
        }
    }
    
    /**
     * Creates a new patient.
     * 
     * @return Object
     */
    private function createPatient($data)
    {
        return $this->patient()->make([
            'patient_no' => $data['patient_no'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'ethnicity' => $data['ethnicity'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'status' => $data['status'],
            'is_4P_member' => $data['is_4P_member'],
            'inter_local_health_zone' => $data['inter_local_health_zone'],
            'blood_type' => $data['blood_type'],
            'rh_type' => $data['rh_type'],
            'date_of_death' => $data['date_of_death'],
            'date_of_birth' => $data['date_of_birth'],
        ]);
    }

    /**
     * Generate a new case report.
     * 
     * [patient]
     * [report with details questions and answers]
     * @param Object $data 
     * @return Object
     */
    protected function generate($data)
    {
        if ( !isset($data['patient']) && !isset($data['report']) ) {
            return false;
        }

        $rData = $data['report'];
        $pData = $data['patient'];
        $this->questions = $rData['details'];

        // Create a new patient
        $patient = $this->createPatient($pData);

        if ( !$patient->saveOrFail() ) {
            return false;
        } 
        
        // Assign the address to the patient
        $address = new Address($data['address']);
        $patient->address()->save($address);
        
        // Make the report
        $report = Report::create([
            'uuid' => (string) Str::uuid(),
            'investigator_id' => auth()->user()->id,
            'patient_id' => $patient->id,
            'disease_id' => $rData['disease_id'],
            'date_admitted' => $this->getDateAdmitted(),
            'date_of_onset' => $this->getDateOfOnset(),
            'onset_to_admit' => $this->getOnsetToAdmit(),
            'admit_to_entry' => $this->getAdmitToEntry()
        ]);

        $report->date_of_entry = $report->created_at;

        $patient->fill([
            'age' => $this->getAge($pData['date_of_birth'])
        ])->save();

        MorbidityReport::create([
            'report_id' => $report->id,
            'week' => $this->getMorbidityWeek(),
            'month' => $this->getMorbidityMonth(),
            'year' => $this->getMorbidityYear(),
        ]);

        // Insert in the questions and answers
        // in to the report details in an array
        if ( count($this->questions) > 0 ) {
            foreach($this->questions as $key => $value) {
                ReportDetail::create([
                    'report_id' => $report->id,
                    'section' => $value['section'],
                    'question' => $value['question'],
                    'answer' => $value['answer'],
                ]);
            }
        }

        // notify all users but checks if
        // the number of cases peaked the
        // alert threshold
        $this->notify($report->disease);

        return $report;
    }
}

// AFP Triggers (all are returning an Integer)
// Report to Investigation (date of investigation - date of report)
// Onset to Stool Collection (date of collection - date of onset)
// Collection to Sending (date of sent to RITM - date of collection)
// Received to Result (Date of Result - Date of RITM)
// Result to Classification (Date of Classification - Date of Result)
// Follow Up (Expected Date - Actual Date)