<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notificacion', function (Blueprint $table) {
            // Usa unsignedInteger porque en pqrsf.idPQRSF es int(11)
            $table->unsignedInteger('idPQRSF')->after('idUsuario');

            $table->foreign('idPQRSF')
                ->references('idPQRSF')->on('pqrsf')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('notificacion', function (Blueprint $table) {
            $table->dropForeign(['idPQRSF']);
            $table->dropColumn('idPQRSF');
        });
    }


};
