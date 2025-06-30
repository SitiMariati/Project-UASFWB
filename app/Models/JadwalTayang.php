<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTayang extends Model
{
    use HasFactory;

    protected $fillable = ['film_id', 'tanggal_tayang', 'jam_tayang', 'studio', 'harga_tiket'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}

