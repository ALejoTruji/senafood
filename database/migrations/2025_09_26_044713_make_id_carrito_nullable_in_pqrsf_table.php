<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pqrsf', function (Blueprint $table) {
            // 🔑 Eliminar la foreign key usando el nombre correcto
            $table->dropForeign('pqrsf_ibfk_2');
        });

        Schema::table('pqrsf', function (Blueprint $table) {
            // Modificar columna para aceptar NULL
            $table->unsignedBigInteger('idCarrito')->nullable()->change();

            // Volver a crear la foreign key
            $table->foreign('idCarrito')
                  ->references('idCarrito')
                  ->on('carrito')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('pqrsf', function (Blueprint $table) {
            $table->dropForeign(['idCarrito']);
            $table->unsignedBigInteger('idCarrito')->nullable(false)->change();
            $table->foreign('idCarrito')
                ->references('idCarrito')
                ->on('carrito')
                ->onDelete('cascade');
        });
    }
};


