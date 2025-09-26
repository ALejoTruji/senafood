<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notificacion', function (Blueprint $table) {
            // Primero eliminamos la foreign key si existe
            $table->dropForeign(['idCarrito']);

            // Luego la volvemos a crear con las reglas que necesites
            $table->foreign('idCarrito')
                  ->references('idCarrito')->on('carrito')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('notificacion', function (Blueprint $table) {
            $table->dropForeign(['idCarrito']);
            $table->foreign('idCarrito')
                  ->references('idCarrito')->on('carrito');
        });
    }
};
