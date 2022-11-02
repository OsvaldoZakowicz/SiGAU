<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id('id');

            //tiene un tipo de identificacion
            $table->string('identification_type_id', 10);
            $table->foreign('identification_type_id')
                ->references('identification_type')
                ->on('personal_identification_types');
                //->nullOnDelete(); //si elimino un tipo de ID

            $table->string('identificationNumber', 15)->unique();
            $table->string('lastName', 95);
            $table->string('firstName', 95);

            //tiene un genero
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')
                ->references('id')
                ->on('genders');
                //->nullOnDelete(); //si elimino un genero

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
