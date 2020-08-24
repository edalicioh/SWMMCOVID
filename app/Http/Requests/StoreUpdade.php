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
        $id = $this->segment(4);
        return [
            'cpf'                   => "unique:people,cpf,{$id},id",
          /*   'street'                => 'required|min:3',
            'number'                => 'required',
            'state_id'              => 'required',
            'city_id'               => 'required',
            'district_id'           => 'required',

            'name'                  => 'required|min:3',
            'gender'                => 'required',
             'phone'                 => 'required|min:11',
            'age'                   => 'required',
            'work_status'           => 'required',
            'status'                => 'required',
            'first_medical_care'    => 'required', */
        ];
    }
}
