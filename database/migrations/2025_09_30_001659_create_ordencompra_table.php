<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ordencompra', function (Blueprint $table) {
            $table->id('idOrden');
            $table->date('fecha');
            $table->string('estado', 50)->default('pendiente');
            $table->foreignId('idProveedor')->constrained('proveedores')->onDelete('cascade');
            $table->foreignId('idUsuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('producto')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precioUnitario', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordencompra');
    }
};