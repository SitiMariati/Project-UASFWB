<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'motede_pembayaran',
        'jumlah_bayar',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}