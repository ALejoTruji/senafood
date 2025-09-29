<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Aquí definimos la estructura de la tabla `proveedor`.
     */
    public function up(): void
    {
        Schema::create('proveedor', function (Blueprint $table) {
            // 🔑 ID principal del proveedor
            $table->bigIncrements('idProveedor'); 

            // Nombre del proveedor
            $table->string('nombre', 255);

            // Contacto del proveedor
            $table->string('contacto', 255)->nullable();

            // Teléfono del proveedor
            $table->string('telefono', 15)->nullable();

            // Dirección del proveedor
            $table->string('direccion', 255)->nullable();

            // NIT del proveedor
            $table->string('NIT', 20)->nullable();

            // Campos de Laravel (created_at y updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Borra la tabla en caso de rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
