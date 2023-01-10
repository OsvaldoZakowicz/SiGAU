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
        Schema::create('cleaning_areas', function (Blueprint $table) {
            $table->id('id');
            $table->string('name',95)->unique();
            $table->text('cleaning_description');
            $table->integer('cleaning_frequency',false,true);
            $table->integer('cleaning_points',false,true);
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
        Schema::dropIfExists('cleaning_areas');
    }
};
