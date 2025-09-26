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
        Schema::table('notificacion', function (Blueprint $table) {
            if (!Schema::hasColumn('notificacion', 'leida')) {
                $table->boolean('leida')->default(0);
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notificacion', function (Blueprint $table) {
            // eliminamos la columna si hacemos rollback
            $table->dropColumn('fechaLeida');
        });
    }
};
