<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['user_profiles_id', 'jadwal_tayang_id', 'jumlah_tiket', 'total_harga', 'status'];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_profiles_id');
    }

    public function jadwalTayang()
    {
        return $this->belongsTo(JadwalTayang::class, 'jadwal_tayang_id');
    }
}
