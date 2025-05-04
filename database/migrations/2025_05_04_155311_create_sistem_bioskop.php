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
            $table->string('kata_sandi');
            $table->enum('peran', ['admin', 'petugas', 'pelanggan'])->default('pelanggan');
            $table->timestamps();
        });

        // Tabel film
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->integer('durasi'); // dalam menit
            $table->string('url_poster')->nullable();
            $table->timestamps();
        });

        // Tabel jadwal tayang
        Schema::create('jadwal_tayang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('film')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->integer('harga');
            $table->timestamps();
        });

        // Tabel pesanan
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
            $table->foreignId('jadwal_tayang_id')->constrained('jadwal_tayang')->onDelete('cascade');
            $table->integer('jumlah_tiket');
            $table->integer('total_harga');
            $table->enum('status', ['menunggu', 'dibayar', 'dibatalkan'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('jadwal_tayang');
        Schema::dropIfExists('film');
        Schema::dropIfExists('pengguna');
    }
};
