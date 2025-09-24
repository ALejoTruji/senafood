<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('producto', function (Blueprint $table) {
            // Cambiamos el tipo de dato de imagen para que soporte rutas largas
            $table->text('imagen')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('producto', function (Blueprint $table) {
            // Revertimos a string con longitud 255
            $table->string('imagen', 255)->nullable()->change();
        });
    }
};

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Aquí definimos la estructura de la tabla `producto`.
     */
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            // 🔑 ID principal del producto
            $table->bigIncrements('idProducto'); 

            // (Opcional) Relación con inventario (si manejas otra tabla inventario)
            // Lo dejamos nullable por ahora, así no da error si no lo llenas.
            $table->unsignedBigInteger('idInventario')->nullable();

            // Nombre del producto
            $table->string('nombre', 255);

            // Descripción del producto (puede ser texto largo)
            $table->text('descripcion')->nullable();

            // Costo unitario
            $table->decimal('costo_unitario', 10, 2);

            // Stock disponible
            $table->integer('stock')->default(0);

            // Fecha de vencimiento (nullable, porque no todos los productos la necesitan)
            $table->date('fecha_vencimiento')->nullable();

            // Categoría (ejemplo: "Bebidas", "Aseo", etc.)
            $table->string('categoria', 255)->nullable();

            // Código de barras
            $table->string('codigo_barras', 255)->nullable();

            // Estado (ejemplo: activo/inactivo)
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            // Imagen (ruta del archivo en storage/app/public/productos)
            $table->string('imagen', 500)->nullable(); 

            // Campos de Laravel (created_at y updated_at)
            $table->timestamps();

            // (Opcional) Definir clave foránea a inventario si existe esa tabla
            // $table->foreign('idInventario')->references('idInventario')->on('inventario')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Borra la tabla en caso de rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
