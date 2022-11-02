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
        Schema::create('phones', function (Blueprint $table) {
            $table->id('id');
            $table->string('number', 15)->unique();

            //pertenece a una persona
            $table->unsignedBigInteger('people_id');
            $table->foreign('people_id')
                ->references('id')
                ->on('people')
                ->cascadeOnDelete(); //si elimino una persona
                
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
        Schema::dropIfExists('phones');
    }
};
