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
        Schema::table('jadwal_tayangs', function (Blueprint $table) {
            // Drop the old waktu_tayang column if it exists
            if (Schema::hasColumn('jadwal_tayangs', 'waktu_tayang')) {
                $table->dropColumn('waktu_tayang');
            }
            
            // Make studio nullable with default value
            $table->string('studio')->nullable()->default('Studio 1')->change();
            
            // Make harga_tiket nullable with default value
            $table->decimal('harga_tiket', 10, 2)->nullable()->default(35000)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_tayangs', function (Blueprint $table) {
            // Revert changes if needed
            $table->string('studio')->nullable(false)->change();
            $table->decimal('harga_tiket', 10, 2)->nullable(false)->change();
        });
    }
};
