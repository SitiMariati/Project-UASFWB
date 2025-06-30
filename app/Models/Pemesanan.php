<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'jadwal_tayang_id', 
        'jumlah_tiket', 
        'total_harga',
        'status',
        'status_tiket'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalTayang::class, 'jadwal_tayang_id');
    }
 
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
