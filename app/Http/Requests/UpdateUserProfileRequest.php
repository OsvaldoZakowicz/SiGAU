<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\User\ProfileService;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'street' => Str::lower($this->street),
            'last_name' => Str::lower($this->last_name),
            'first_name' => Str::lower($this->first_name),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string, mixed>
     */
    public function rules(ProfileService $profileService)
    {
        $regex = $profileService->obtenerFormatoRegexTipoId($this->tipo_id);

        return [
            'tipo_id'   =>  ['required'],
            'number_id' =>  [
                'required',
                'regex:/^' . $regex[0]->format . '$/i',
                'max_digits:15',
                'min_digits:8'
            ],
            'gender'    =>  ['required'],
            'last_name' =>  ['required', 'regex:/^([a-zA-Z\s]{0,95})$/i', 'max:95'],
            'first_name'    =>  ['required', 'regex:/^([a-zA-Z\s]{0,95})$/i', 'max:95'],
            'phone_number'  =>  [
                'required',
                'numeric',
                'max_digits:15',
                'min_digits:10',
            ],
            'street'        =>  ['required', 'regex:/^([a-zA-Z\s]{0,95})$/i', 'max:95'],
            'street_number' =>  ['required', 'numeric', 'max_digits:10'],
            'house_number'  =>  ['nullable', 'alpha_num', 'max:10'],
            'department_number' =>  ['nullable', 'alpha_num', 'max:10'],
            'floor_number'  =>  ['nullable', 'numeric', 'max_digits:10'],
            'location'  =>  ['required']
        ];
    }

    /**
     * obtener mensajes de validacion especificos por
     * cada regla de validacion.
     * @return array
     */
    public function messages()
    {
        return [
            'tipo_id.required' => 'se requiere elija un :attribute',
            'number_id.required' => 'se requiere ingrese su :attribute',
            'number_id.regex' => 'el numero no coincide con el tipo de identificacion',
            'gender.required' => 'se requiere el :attribute según su identificación',
            'last_name.required' => 'se requiere ingrese su :attribute',
            'last_name.regex' => ':attribute solo con letras',
            'first_name.required' => 'se requiere ingrese su :attribute',
            'first_name.regex' => ':attribute solo con letras',
            'phone_number.required' => 'se requiere ingrese su :attribute',
            'phone_number.min_digits' => 'verifique el formato, incluya caracteristica y número',
            'phone_number.max_digits' => ':attribute muy largo, incluya caracteristica y número',
            'street.required' => 'se requiere ingrese su :attribute',
            'street.regex' => ':attribute solo con letras',
            'street_number.required' => 'se requiere ingrese su :attribute',
            'street_number.numeric' => ':attribute debe ser un número',
            'street_number.max_digits' => ':attribute muy largo, maximo 10 digitos',
            'house_number.alpha_num' => ':attribute solo con letras y numeros',
            'house_number.max' => ':attribute muy largo, maximo 10 caracteres',
            'department_number.alpha_num' => ':attribute solo con letras y numeros',
            'department_number.max' => ':attribute muy largo, maximo 10 caracteres',
            'floor_number.numeric' => ':attribute debe ser un numero',
            'floor_number.max_digits' => ':attribute muy largo, maximo 10 digitos',
            'location.required' => 'se requiere ingrese su :attribute',
        ];
    }

    /**
     * nombres especificos de los atributos para mensajes
     * de validacion, nombres mas amigables.
     * @return array
     */
    public function attributes()
    {
        return [
            'tipo_id' => 'tipo de identificacion',
            'number_id' => 'numero de identificacion',
            'gender' => 'genero',
            'last_name' => 'apellido',
            'first_name' => 'nombre/s',
            'phone_number' => 'teléfono móvil',
            'street' => 'calle',
            'street_number' => 'numero/altura de calle',
            'house_number' => 'numero de casa',
            'department_number' => 'numero de depto.',
            'floor_number' => 'numero de piso',
            'location' => 'localidad/lugar de origen'
        ];
    }
}
