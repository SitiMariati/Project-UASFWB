<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film';

    protected $fillable = [
        'judul', 'deskripsi', 'durasi', 
    ];

    public function jadwalTayang()
    {
        return $this->hasMany(JadwalTayang::class);
    }
}

