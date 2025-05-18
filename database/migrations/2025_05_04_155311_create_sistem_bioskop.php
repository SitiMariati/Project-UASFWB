<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Film
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('genre');
            $table->timestamps();
        });

        // Tabel Jadwal Tayang
        Schema::create('jadwal_tayang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('film')->onDelete('cascade');
            $table->dateTime('waktu_tayang');
            $table->timestamps();
        });

        // Tabel Pemesanan
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jadwal_tayang_id')->constrained('jadwal_tayang')->onDelete('cascade');
            $table->integer('jumlah_tiket');
            $table->timestamps();
        });

        // Tabel Pembayaran
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade');
            $table->string('metode_pembayaran');
            $table->integer('jumlah_bayar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('jadwal_tayang');
        Schema::dropIfExists('film');
    }
};
