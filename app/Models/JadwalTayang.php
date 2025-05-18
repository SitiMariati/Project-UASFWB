<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalTayang extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'waktu_tayang',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function pesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
