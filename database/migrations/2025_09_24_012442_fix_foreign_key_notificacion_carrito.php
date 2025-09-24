<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notificacion', function (Blueprint $table) {
            // Obtenemos el schema manager de Doctrine
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->listTableDetails('notificacion');

            // Si existe la foreign key, la eliminamos
            if ($doctrineTable->hasForeignKey('notificacion_idcarrito_foreign')) {
                $table->dropForeign('notificacion_idcarrito_foreign');
            }

            // Si existe el campo, lo eliminamos
            if (Schema::hasColumn('notificacion', 'idCarrito')) {
                $table->dropColumn('idCarrito');
            }
        });

        // Ahora recreamos el campo y la foreign key correcta
        Schema::table('notificacion', function (Blueprint $table) {
            $table->unsignedBigInteger('idCarrito')->nullable()->after('idUsuario');

            $table->foreign('idCarrito')
                ->references('idCarrito')->on('carrito')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('notificacion', function (Blueprint $table) {
            if (Schema::hasColumn('notificacion', 'idCarrito')) {
                $table->dropForeign(['idCarrito']);
                $table->dropColumn('idCarrito');
            }
        });
    }
};
