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
        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('phone_id')
                ->nullable()
                ->after('first_name');
            $table->foreign('phone_id')
                ->references('id')
                ->on('phones')
                ->cascadeOnDelete(); //si elimino una persona
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            //forma correcta de eliminar una clave foranea
            $table->dropForeign('people_phone_id_foreign');
            $table->dropColumn('phone_id');
        });
    }
};
