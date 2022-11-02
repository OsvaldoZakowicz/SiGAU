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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('people_id')
                ->nullable()
                ->after('password');
            $table->foreign('people_id')
                ->references('id')
                ->on('people')
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
        Schema::table('users', function (Blueprint $table) {
            //forma correcta de eliminar una clave foranea
            $table->dropForeign('users_people_id_foreign');
            $table->dropColumn('people_id');
        });
    }
};
