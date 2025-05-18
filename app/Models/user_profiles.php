<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_profiles extends Model
{
    protected $fillable = ['pengguna_id', 'alamat', 'no_hp', 'tanggal_lahir'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'user_profiles_id');
    }
}


