<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel pengguna
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'petugas', 'pengguna'])->default('pengguna');
           
         }); 
          // Tabel user_profiles   
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
           $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
            $table->string('alamat');
            $table->string('no_hp');
            $table->date('tanggal_lahir');
            $table->timestamps();

        });

        // Tabel film
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('genre');
            $table->integer('durasi');
            $table->text('deskripsi');
            $table->timestamps();

        });

        // Tabel jadwal tayang
        Schema::create('jadwal_tayang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('film')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_tayang');
            $table->integer('harga');
            $table->timestamps();

        });

        // Tabel pesanan
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_profiles_id')->constrained('pengguna')->onDelete('cascade');
            $table->foreignId('jadwal_tayang_id')->constrained('jadwal_tayang')->onDelete('cascade');
            $table->integer('jumlah_tiket');
            $table->integer('total_harga');
            $table->enum('status', ['menunggu', 'dibayar', 'dibatalkan'])->default('menunggu');
            $table->timestamps();
        });
        // Tabel pivot pengguna <-> film (many to many)
Schema::create('film_pengguna', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
    $table->foreignId('film_id')->constrained('film')->onDelete('cascade');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('jadwal_tayang');
        Schema::dropIfExists('film');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('film_pengguna');
    }
};
