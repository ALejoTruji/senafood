<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * tabla de promociones 
     */
    public function up(): void
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();
            $table->morphs('titulo');
            $table->text('descripcion')->nullable();
            $table->string('descuento', 5,2);//porcentaje 
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();
        });
    }

    /**
     * se refiere a revertir un cambio que ya se aplicó,
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
