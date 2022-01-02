<?php

namespace App\Http\Controllers;

use App\Address;
use App\DRU;
use App\Http\Requests\DRURequest;
use App\Mail\NewDRUOfficer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DRUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DRUs = DRU::get();

        return response()->json($DRUs, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DRURequest $request)
    {
        $diseaseUnit = $request->dru;
        $officer = $request->officer;
        
        $dru = DRU::create([
            'name' => $diseaseUnit['name'], 
            'type' => $diseaseUnit['type'], 
            'national_sentinel_site' => $diseaseUnit['national_sentinel_site'], 
        ]);

        $druAddress = new Address([
            'region' => $diseaseUnit['region'], 
            'province' => $diseaseUnit['province'], 
            'municity' => $diseaseUnit['municity'], 
            'barangay' => $diseaseUnit['barangay'], 
            'street' => $diseaseUnit['street'], 
            'district' => $diseaseUnit['district'], 
        ]);

        $dru->address()->save($druAddress);

        $user = new User();
        $generatedPassword = $user->generatePassword();

        $druOfficer = $user->create([
            'dru_id' => $dru->id,
            'first_name' => $officer['first_name'],
            'middle_name' => $officer['middle_name'],
            'last_name' => $officer['last_name'],
            'email' => $officer['email'],
            'password' => bcrypt($generatedPassword),
            'phone_number' => $officer['phone_number'],
            'date_started' => $officer['date_started']
        ]);

        $address = new Address([
            'region' => $officer['region'],
            'province' => $officer['province'],
            'municity' => $officer['municity'],
            'barangay' => $officer['barangay'],
            'street' => $officer['street'],
            'district' => $officer['district'],
        ]);

        $druOfficer->address()->save($address);
        
        $druOfficer->setRole('officer');

        // sends the generated password in email
        Mail::to($druOfficer->email)->queue(new NewDRUOfficer(
            $druOfficer, $generatedPassword
        ));

        return response()->json([
            'message' => 'A Disease Reporting Unit (DRU) has been added successfully.',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DRU  $dRU
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dru = DRU::with('officer')
            ->where('id', $id)
            ->first();

        return response()->json($dru, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DRU  $dRU
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dru = DRU::findOrFail($id);
        $address = $request->address;

        $dru->fill([
            'name' => $request->name,
            'type' => $request->type,
            'national_sentinel_site' => $request->national_sentinel_site,
            'philmis_site' => $request->philmis_site
        ])->save();

        $dru->address->fill([
            'region' => $address['region'] ?? null,
            'province' => $address['province'] ?? null,
            'municity' => $address['municity'] ?? null,
            'barangay' => $address['barangay'] ?? null,
            'street' => $address['street'] ?? null,
            'district' => $address['district'] ?? null,
        ])->save();

        return response()->json($dru);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DRU  $dRU
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dru = DRU::find($id);
        
        return response()->json($dru->delete());
    }
}
