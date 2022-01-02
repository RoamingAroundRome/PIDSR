<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DRURequest extends FormRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    // public function validationData()
    // {
    //     return $this->merge([
    //         'dru' => json_encode($this->get('dru'), true),
    //         'officer' => json_encode($this->get('officer'), true)
    //     ])->all();
    // }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dru.name' => 'required',
            'dru.type' => 'required',
            'dru.region' => 'required',
            'dru.province' => 'required',
            'dru.municity' => 'required',

            'officer.first_name' => 'required',
            'officer.middle_name' => 'required',
            'officer.last_name' => 'required',
            'officer.email' => 'required',
            'officer.phone_number' => 'required',
            'officer.region' => 'required',
            'officer.province' => 'required',
            'officer.municity' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'dru.name' => 'DRU name',
            'dru.type' => 'type',
            'dru.region' => 'region',
            'dru.province' => 'province',
            'dru.municity' => 'municity',

            'officer.first_name' => 'first name',
            'officer.middle_name' => 'middle name',
            'officer.last_name' => 'last name',
            'officer.email' => 'email',
            'officer.phone_number' => 'phone number',
            'officer.region' => 'region',
            'officer.province' => 'province',
            'officer.municity' => 'municity',
        ];
    }
}
