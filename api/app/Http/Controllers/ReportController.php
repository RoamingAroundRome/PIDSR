<?php

namespace App\Http\Controllers;

use App\DRU;
use App\Report;
use Illuminate\Http\Request;
use Spatie\Regex\Regex;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Report::get());
    }

    /**
     * Get all latest entries of DRUs.
     * 
     * @return \Illuminate\Http\Response
     */
    public function allLatestEntries()
    {
        $drus = DRU::get()
            ->map(function ($data) {
                return $data->latestEntries();
            });
            
        return response()->json($drus);
    }

    /**
     * Get all latest entries of officer.
     * 
     * @return \Illuminate\Http\Response
     */
    public function latestEntries()
    {
        return response()->json([
            !auth()->user()->hasRole('admin') ? 
                auth()->user()->dru->latestEntries() 
                : []
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cases()
    {
        $report = new Report();

        $cases = [
            'past_hour' => $report->getCasesPastHour(),
            'past_week' => $report->getCasesPastWeek(),
            'past_month' => $report->getCasesPastMonth(),
        ];

        return response()->json($cases);
    }

    /**
     * Search query for the reporting module.
     * 
     * @param Object $request
     * @return Object 
     */
    public function search(Request $request)
    {
        $results = Report::dateRange(
                $request->get('min_date'), 
                $request->get('max_date')
            )->diseaseId($request->get('disease_id'))
            ->region($request->get('region'))
            ->municity($request->get('municity'))
            ->get();

        // group by morbidity weeks
        $casesPerMorbidityWeek = $results->groupBy('morbidity_report.week');
        // group by barangays where patient's address is
        $casesPerBarangay = $results->groupBy('patient.address.barangay');

        // map the patient so they contain an outcome
        // it may be among the 3 (Alive, Died, & Unconfirmed)
        $patientList = $results->pluck('patient')->map(function ($data) {
            // the DRU the investigator is associated with
            $dru = $data->report->investigator->dru;
            $morbidityReport = $data->report->morbidity_report;

            $data['dru_name'] = $dru->name;
            $data['dru_type'] = $dru->name;
            $data['date_of_entry'] = $data->report->date_of_entry;
            $data['date_admitted'] = $data->report->date_admitted;
            $data['date_of_onset'] = $data->report->date_of_onset;
            $data['date_of_investigation'] = $data->report->date_of_investigation;
            $data['admit_to_entry'] = $data->report->admit_to_entry;
            $data['onset_to_admit'] = $data->report->onset_to_admit;
            $data['time_of_investigation'] = $data->report->time_of_investigation;
            $data['time_of_onset'] = $data->report->time_of_onset;
            $data['interval_from_onset_to_notif'] = $data->report->interval_from_onset_to_notif;
            $data['interval_from_notif_to_investigation'] = $data->report->interval_from_notif_to_investigation;
            $data['morbidity_week'] = $morbidityReport->week;
            $data['morbidity_month'] = $morbidityReport->month;
            $data['morbidity_year'] = $morbidityReport->year;
            $data['outcome'] = $data->getOutcome();
            $data['full_name'] = $data->getFullName();
            $data['region'] = $data->address->region;
            $data['province'] = $data->address->province;
            $data['municity'] = $data->address->municity;
            $data['barangay'] = $data->address->barangay;
            $data['street'] = $data->address->street;
            $data['district'] = $data->address->district;
            unset($data['address']);
            unset($data['report']);
            unset($data['updated_at']);
            unset($data['deleted_at']);

            return $data;
        });

        // get the mapped grouped cases per barangay
        $groupedCasesPerBarangay = $this->groupCasesPerBarangay($casesPerBarangay);
        
        return response()->json([
            'results' => $results,
            'cases_per_morbidity_week' => $casesPerMorbidityWeek,
            'cases_per_barangay' => $groupedCasesPerBarangay,
            'patient_list' => $patientList,
            'min_date' => $request->get('min_date'),
            'max_date' => $request->get('max_date'),
        ]);
    }

    /**
     * Group cases per barangay then map it.
     * e.g. {
     *  barangay: string,
     *  cases: int,
     *  alive: int,
     *  dead: int,
     *  unconfirmed: int,
     * }
     * 
     * @param Array
     * @return Array
     */
    private function groupCasesPerBarangay($data)
    {
        if ( !isset($data) && count($data) > 0 ) {
            return null;
        }

        $cases = [];
        foreach ($data as $key => $value) {
            $outcomes = [];
            if (count($value) > 0) {
                foreach ($value as $val) {
                    array_push($outcomes, $val->getOutcome());
                }
            }

            $outcomeObj = array_count_values($outcomes);
            
            $obj = [
                'barangay' => $key,
                'cases' => count($value),
            ];
            $obj['alive'] = $outcomeObj['Alive (A)'] ?? 0;
            $obj['died'] = $outcomeObj['Dead (D)'] ?? 0;
            $obj['unconfirmed'] = $outcomeObj['Unconfirmed (U)'] ?? 0;

            array_push($cases, $obj);
        }

        return $cases;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = Report::generate($request->all());

        if ( !$report ) {
            abort(403, "The attempt to generate a case report failed.");
        }
        
        return response()->json($report);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
