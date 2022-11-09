<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        //'atributo_del_formulario' => 'regla_a_cumplir'
        return [
            'tipo_id'           => 'required',
            'number_id'         => 'required|max:15|unique:people,identification_number',
            'gender'            => 'required',
            'last_name'         => 'required|max:95',
            'first_name'        => 'required|max:95',
            'phone_number'      => 'required|max:15|unique:phones,number',
            'street'            => 'required|max:95',
            'street_number'     => 'required|max:10',
            'house_number'      => 'nullable|max:10',
            'department_number' => 'nullable|max:10',
            'floor_number'      => 'nullable|max:10',
            'location'         => 'required'
        ];
    }
}
