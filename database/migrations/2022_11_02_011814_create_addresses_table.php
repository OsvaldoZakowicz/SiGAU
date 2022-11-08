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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('id');
            $table->string('street', 10)->nullable();
            $table->string('streetNumber', 10)->nullable();
            $table->string('houseNumber', 10)->nullable();
            $table->string('floorNumber', 10)->nullable();
            $table->string('departmentNumber', 10)->nullable();

            //pertenece a una persona
            $table->unsignedBigInteger('people_id');
            $table->foreign('people_id')
                ->references('id')
                ->on('people')
                ->cascadeOnDelete(); //si elimino una persona

            //pertenece a una ubicacion
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')
                ->references('id')
                ->on('locations');
                
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
        Schema::dropIfExists('addresses');
    }
};