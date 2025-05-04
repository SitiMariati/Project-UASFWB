<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'pengguna_id', 'jadwal_tayang_id', 'jumlah_tiket', 'total_harga', 'status',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function jadwalTayang()
    {
        return $this->belongsTo(JadwalTayang::class);
    }
}
