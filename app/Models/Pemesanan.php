<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'jadwal_tayang_id',
    'jumlah_tiket',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function jadwalTayang()
  {
    return $this->belongsTo(JadwalTayang::class);
  }

  public function pembayaran()
  {
    return $this->hasOne(Pembayaran::class);
  }
}