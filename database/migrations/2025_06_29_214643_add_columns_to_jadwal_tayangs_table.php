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
            $table->date('tanggal_tayang')->after('film_id');
            $table->time('jam_tayang')->after('tanggal_tayang');
            $table->string('studio')->after('jam_tayang');
            $table->decimal('harga_tiket', 10, 2)->after('studio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_tayangs', function (Blueprint $table) {
            $table->dropColumn(['tanggal_tayang', 'jam_tayang', 'studio', 'harga_tiket']);
        });
    }
};
