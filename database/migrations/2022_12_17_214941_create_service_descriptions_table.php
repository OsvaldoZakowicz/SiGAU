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
        Schema::create('service_descriptions', function (Blueprint $table) {
            $table->id('id');
            $table->integer('dia_llegada_boleta',false,true);
            $table->integer('periodo_recaudacion',false,true);
            $table->integer('dia_pago_servicio',false,true);
            $table->integer('maximo_pagos_adeudados',false,true);
            //clave foranea service types
            $table->unsignedBigInteger('service_types_id');
            $table->foreign('service_types_id')->references('id')->on('service_types');
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
        Schema::dropIfExists('service_descriptions');
    }
};
