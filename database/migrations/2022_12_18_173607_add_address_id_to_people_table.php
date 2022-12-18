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
            $table->unsignedBigInteger('address_id')
                ->nullable()
                ->after('phone_id');
            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
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
            $table->dropForeign('people_address_id_foreign');
            $table->dropColumn('address_id');
        });
    }
};
