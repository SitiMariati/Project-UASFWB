<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal_tayang extends Model
{
    protected $table = 'jadwal_tayang';

    protected $fillable = ['film_id', 'tanggal', 'jam_tayang', 'harga'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'jadwal_tayang_id');
    }
}
