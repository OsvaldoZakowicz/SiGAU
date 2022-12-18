<?php

namespace App\Services\User;

use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Models\Phone;
use App\Models\User;
use App\Models\Address;

/**
 * *Servicios para perfil de usuario
 * - tipos de identificaciones
 * - generos
 * - telefonos
 * - perfil (persona)
 * - direcciones
 * - localidades
 * - provincias
 * - paises
 */

class ProfileService
{
    //*constructor
    function __construct() {}

    /**
     * *obtener los tipos de identificacion
     * personal.
     * @return array ['id_type' => 'id_type']
     */
    public function obtenerTiposIdentificacion()
    {
        return DB::table('personal_identification_types')
            ->select('identification_type as id_type', 'format')
            ->pluck('id_type', 'id_type');
    }

    /**
     * *obtener formato regex que valida
     * un tipo de identificacion personal.
     */
    public function obtenerFormatoRegexTipoId($tipo_id)
    {
        return DB::table('personal_identification_types')
            ->select('format')
            ->where('identification_type','=',$tipo_id)
            ->get();
    }

    /**
     * *obtener los generos
     * aplicables a perfiles.
     * @return array ['name' => 'id']
     */
    public function obtenerGeneros()
    {
        return DB::table('genders')
            ->select('id', 'name')
            ->pluck('name', 'id');
    }

    /**
     * *crear un perfil.
     * datos de persona.
     * @return Person persona.
     */
    public function crearPerfil(Array $parametros, User $user, Phone $phone, Address $address)
    {
        $people = Person::create([
            'identification_type_id' => $parametros['tipo_id'],
            'identification_number' => $parametros['number_id'],
            'last_name' => $parametros['last_name'],
            'first_name' => $parametros['first_name'],
            'gender_id' => $parametros['gender'],
            'phone_id' => $phone->id,
            'address_id' => $address->id
        ]);

        //asignar perfil a usuario
        $user->people_id = $people->id;
        $user->save();

        return $people;
    }

    /**
     * *actualizar perfil.
     * datos de una persona.
     * @return Person persona.
     */
    public function actualizarPerfil(Array $parametros, User $user)
    {
        $people = $user->people;
        $people->identification_type_id = $parametros['tipo_id'];
        $people->identification_number = $parametros['number_id'];
        $people->gender_id = $parametros['gender'];
        $people->last_name = $parametros['last_name'];
        $people->first_name = $parametros['first_name'];
        $people->save();

        return $people;
    }

    /**
     * *crear telefono.
     * telefono de una persona.
     * @return Phone telefono.
     */
    public function crearTelefono(Array $parametros)
    {
        $phone = Phone::create([
            'number' => $parametros['phone_number'],
        ]);

        return $phone;
    }

    /**
     * *actualizar telefono
     * telefono de una persona.
     * @return Phone telefono.
     */
    public function actualizarTelefono(Array $parametros, Person $people)
    {
        $phone = $people->phone;
        $phone->number = $parametros['phone_number'];
        $phone->save();

        return $phone;
    }

    /**
     * *crear direccion.
     * direccion de una persona.
     * @return Address direccion.
     */
    public function crearDireccion(Array $parametros)
    {
        $address = Address::create([
            'street' => $parametros['street'],
            'street_number' => $parametros['street_number'],
            'house_number' => $parametros['house_number'],
            'floor_number' => $parametros['floor_number'],
            'department_number' => $parametros['department_number'],
            'location_id' => $parametros['location']
        ]);

        return $address;
    }

    /**
     * *actualizar direccion.
     * direccion de una persona.
     * @return Address direccion.
     */
    public function actualizarDireccion(Array $parametros, Person $people)
    {
        $address = $people->address;
        $address->street = $parametros['street'];
        $address->street_number = $parametros['street_number'];
        $address->house_number = $parametros['house_number'];
        $address->floor_number = $parametros['floor_number'];
        $address->department_number = $parametros['department_number'];
        $address->location_id = $parametros['location'];
        $address->save();

        return $address;
    }

    /**
     * *obtener perfil completo.
     * @return array un elemento de array tipo clase.
     */
    public function obtenerPerfilCompleto(User $user)
    {
        $datos = DB::table('people')
            ->join('users','people.id','=','users.people_id')
            ->join('genders','people.gender_id','=','genders.id')
            ->join('phones','people.phone_id','=','phones.id')
            ->join('addresses','people.address_id','=','addresses.id')
            ->select(
                'people.id as profile_id',
                'people.identification_type_id as profile_id_type',
                'people.identification_number as profile_id_number',
                'people.last_name as profile_last_name',
                'people.first_name as profile_first_name',
                'genders.id as profile_gender_id',
                'genders.name as profile_gender_name',
                'phones.id as profile_phone_id',
                'phones.number as profile_phone_number',
                'addresses.id as profile_address_id',
                'addresses.street as profile_address_street',
                'addresses.street_number as profile_address_number',
                'addresses.house_number as profile_address_house_number',
                'addresses.floor_number as profile_address_floor_number',
                'addresses.department_number as profile_address_department_number',
                'addresses.location_id as profile_address_location_id'
                )
            ->where('users.id','=',$user->id)
            ->get()
            ->toArray();

            //obtener el primer elemento
            return array_shift($datos);
    }

    /**
     * *obtener localidad.
     * y una cadena representativa de localidad, provincia, pais
     */
    public function obtenerLocalidadActual(User $user)
    {
        //datos del perfil de usuario
        $user_profile = $user->people;
        $user_address = $user_profile->address;
        
        //direccion especifica, localidad - provincia - pais
        $user_location = $user_address->location;
        $user_province = $user_location->province;
        $user_country = $user_province->country;

        $user_location_string = 'localidad: ' . $user_location->name . ' codigo postal: ' . $user_location->postal_code . ' provincia: ' . $user_province->name . ' pais: ' . $user_country->name;

        //necesito un array de facil acceso
        return [
            'id' => $user_address->location_id,
            'value' => $user_location_string
        ];        
    }
}
