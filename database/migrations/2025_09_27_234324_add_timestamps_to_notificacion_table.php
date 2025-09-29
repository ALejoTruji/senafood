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
        Schema::table('notificacion', function (Blueprint $table) {
            // Solo agrega los timestamps si no existen
            if (!Schema::hasColumn('notificacion', 'created_at') && !Schema::hasColumn('notificacion', 'updated_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('notificacion', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }

};
