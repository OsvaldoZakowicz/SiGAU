<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Person;
use App\Models\Phone;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    //TODO constructor con middleware?

    /**
     * crear un perfil de usuario.
     */
    public function create(User $user)
    {
        $identificationTypes = DB::table('personal_identification_types')
            ->select('identification_type as id_type', 'format')
            ->pluck('id_type', 'id_type');

        $genders = DB::table('genders')
            ->select('id', 'name')
            ->pluck('name', 'id');
        
        return view('profiles.create-admin-profile', compact('user', 'identificationTypes', 'genders'));
    }

    /**
     * almacenar un perfil de usuario.
     */
    public function store(Request $request)
    {
        //TODO refactor
        //TODO request aparte, validar tipos de id personal

        $identificationTypeFormat = DB::table('personal_identification_types')
        ->select('identification_type as id_type', 'format')
        ->pluck('format', 'id_type')
        ->all(); //['clave' => 'formato']

        $user = User::find(Auth()->user()->id);
        
        $validator = Validator::make($request->all(),[
            'tipo_id'           => 'required',
            'number_id'         => 'required|unique:people,identificationNumber',
            'gender'            => 'required',
            'last_name'         => 'required|max:95',
            'first_name'        => 'required|max:95',
            'phone_number'      => 'required|unique:phones,number',
            'street'            => 'required',
            'street_number'     => 'required',
            'house_number'      => 'nullable',
            'department_number' => 'nullable',
            'floor_number'      => 'nullable',
            'localidad'         => 'required'
        ]);

        $validated = $validator->validated();
            
        $people = Person::create([
            'identification_type_id' => $validated['tipo_id'],
            'identificationNumber' => $validated['number_id'],
            'lastName' => $validated['last_name'],
            'firstName' => $validated['first_name'],
            'gender_id' => $validated['gender']
        ]);

        Phone::create([
            'number' => $validated['phone_number'],
            'people_id' => $people->id
        ]);

        Address::create([
            'street' => $validated['street'],
            'streetNumber' => $validated['street_number'],
            'houseNumber' => $validated['house_number'],
            'floorNumber' => $validated['floor_number'],
            'departmentNumber' => $validated['department_number'],
            'people_id' => $people->id,
            'location_id' => $validated['localidad']
        ]);

        $user->people_id = $people->id;
        $user->save();

        return redirect()->route('show-profile')->with('exito','perfil guardado');
    }

    public function edit(User $user)
    {
        //tipos de identificacion
        $identificationTypes = DB::table('personal_identification_types')
            ->select('identification_type as id_type', 'format')
            ->pluck('id_type', 'id_type');

        //generos
        $genders = DB::table('genders')
            ->select('id', 'name')
            ->pluck('name', 'id');

        //datos del perfil de usuario
        $user_profile = $user->people;
        $user_phone = $user_profile->phone;
        $user_address = $user_profile->address;
        $user_gender = $user_profile->gender;

        //direccion especifica, localidad - provincia - pais
        $user_location = $user_address->location;
        $user_province = $user_location->province;
        $user_country = $user_province->country;

        $user_location_string = 'localidad: ' . $user_location->name . ' codigo postal: ' . $user_location->postal_code . ' provincia: ' . $user_province->name . ' pais: ' . $user_country->name;

        return view('profiles.edit-admin-profile', compact('user','user_profile','user_phone','user_address','user_gender', 'user_location_string', 'identificationTypes', 'genders'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth()->user()->id);
        
        $validator = Validator::make($request->all(),[
            'tipo_id'           => 'required',
            'number_id'         => 'required',
            'gender'            => 'required',
            'last_name'         => 'required|max:95',
            'first_name'        => 'required|max:95',
            'phone_number'      => 'required',
            'street'            => 'required',
            'street_number'     => 'required',
            'house_number'      => 'nullable',
            'department_number' => 'nullable',
            'floor_number'      => 'nullable',
            'localidad'         => 'required'
        ]);

        $validated = $validator->validated();

        //perfil del usuario
        $user_profile = $user->people;
        $user_profile->identification_type_id = $validated['tipo_id'];
        $user_profile->identificationNumber = $validated['number_id'];
        $user_profile->gender_id = $validated['gender'];
        $user_profile->lastName = $validated['last_name'];
        $user_profile->firstName = $validated['first_name'];
        $user_profile->save();

        //telefono
        $user_phone = $user_profile->phone;
        $user_phone->number = $validated['phone_number'];
        $user_phone->save();

        //direccion
        $user_address = $user_profile->address;
        $user_address->street = $validated['street'];
        $user_address->streetNumber = $validated['street_number'];
        $user_address->houseNumber = $validated['house_number'];
        $user_address->floorNumber = $validated['floor_number'];
        $user_address->departmentNumber = $validated['department_number'];
        $user_address->location_id = $validated['localidad'];
        $user_address->save();

        return redirect()->route('show-profile')->with('exito','perfil actualizado');
    }
}
