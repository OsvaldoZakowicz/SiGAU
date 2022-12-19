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
        Schema::create('ambients', function (Blueprint $table) {
            $table->id('id');
            $table->integer('quantity',false,true);

            //clave foranea casas
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')
                ->references('id')
                ->on('houses');

            //clave foranea descripciones de ambiente
            $table->unsignedBigInteger('ambient_description_id');
            $table->foreign('ambient_description_id')
                ->references('id')
                ->on('ambient_descriptions');

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
        Schema::dropIfExists('ambients');
    }
};
