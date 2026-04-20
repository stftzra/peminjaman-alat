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
        Schema::table('alats', function (Blueprint $table) {
            $table->integer('kondisi_baik')->default(0)->after('stok');
            $table->integer('kondisi_rusak')->default(0)->after('kondisi_baik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn(['kondisi_baik', 'kondisi_rusak']);
        });
    }
};
