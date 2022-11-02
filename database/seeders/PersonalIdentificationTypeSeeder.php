<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalIdentificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personal_identification_types')->insert([
            [
                'identification_type' => 'DNI(AR)',
                'format' => '(?:([1-9]{2})([0-9]){3}([0-9]{3}))',
                'created_at' => now()
            ],
            [
                'identification_type' => 'CI(BR)',
                'format' => '(?:([1-9]{3})[\.|\-]?([0-9]){3}[\.|\-]?([0-9]{3})\-([0-9]{2}))',
                'created_at' => now()
            ],
            [
                'identification_type' => 'CI(PY)',
                'format' => '(?:([1-9]{1,2})[\.]?([0-9]){3}[\.]?([0-9]{3}))',
                'created_at' => now()
            ]
        ]);
    }
}
