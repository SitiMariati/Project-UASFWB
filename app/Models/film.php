<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['judul', 'genre', 'durasi', 'deskripsi'];

    public function jadwalTayang()
    {
        return $this->hasMany(JadwalTayang::class, 'film_id');
    }

    public function pengguna()
    {
        return $this->belongsToMany(Pengguna::class, 'film_pengguna');
    }
}
