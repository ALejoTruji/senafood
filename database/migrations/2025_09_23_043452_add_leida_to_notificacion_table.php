<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Esta clase anónima extiende de Migration, lo que permite crear o modificar tablas en la base de datos
return new class extends Migration
{    
    public function up(): void
    {
        // Modificamos la tabla 'notificacion'
        Schema::table('notificacion', function (Blueprint $table) {
            // Se agrega una columna booleana 'leida' con valor por defecto 'false'
            // Sirve para saber si una notificación fue leída o no
            $table->boolean('leida')->default(false);

            // Se agrega una columna tipo timestamp (fecha y hora) llamada 'fechaLeida'
            // Es nullable, es decir, puede quedar vacía si la notificación no se ha leído
            $table->timestamp('fechaLeida')->nullable();
        });
    }
    
    public function down(): void
    {
        // Eliminamos las columnas 'leida' y 'fechaLeida' de la tabla 'notificacion'
        Schema::table('notificacion', function (Blueprint $table) {
            $table->dropColumn(['leida', 'fechaLeida']);
        });
    }
};