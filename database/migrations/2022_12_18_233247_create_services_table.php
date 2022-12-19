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
        Schema::create('services', function (Blueprint $table) {
            $table->id('id');
            $table->string('connection_number',10)->unique();
            $table->string('service_owner', 95);
            $table->string('cuit',11);

            //clave foranea casa
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')
                ->references('id')
                ->on('houses');
            
            //clave foranea descripcion de servicio
            $table->unsignedBigInteger('service_description_id');
            $table->foreign('service_description_id')
                ->references('id')
                ->on('service_descriptions');
            
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
        Schema::dropIfExists('services');
    }
};
