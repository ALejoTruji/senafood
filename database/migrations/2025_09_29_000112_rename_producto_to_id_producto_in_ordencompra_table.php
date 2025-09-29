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
        Schema::table('ordencompra', function (Blueprint $table) {
            $table->renameColumn('producto', 'idProducto');
            $table->integer('idProducto')->change();
        });
    }

    public function down()
    {
        Schema::table('ordencompra', function (Blueprint $table) {
            $table->renameColumn('idProducto', 'producto');
            // Revertir tipo si es necesario
        });
    }
};
