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
        Schema::create('ambient_descriptions', function (Blueprint $table) {
            $table->id('id');
            $table->integer('lights_quantity');
            $table->integer('plugs_quantity');
            $table->string('size', 95)->nullable();
            $table->integer('places_quantity');
            //clave foranea ambient_types
            $table->unsignedBigInteger('ambient_types_id');
            $table->foreign('ambient_types_id')->references('id')->on('ambient_types');
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
        Schema::dropIfExists('ambient_descriptions');
    }
};
