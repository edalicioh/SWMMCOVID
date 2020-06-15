<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdade extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'street'                => 'required|min:3',
            'number'                => 'required',
            'state_id'              => 'required',
            'city_id'               => 'required',
            'district_id'           => 'required',

            'name'                  => 'required|min:3',
            'gender'                => 'required',
            'cpf'                   => 'required|min:11',
            'phone'                 => 'required|min:11',
            'age'                   => 'required',
            'work_status'           => 'required',
            'status'                => 'required',
            'first_medical_care'    => 'required',
        ];
    }
}
