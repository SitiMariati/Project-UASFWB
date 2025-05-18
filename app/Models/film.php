<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\eloquent\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'genre',
    ];

    public function jadwalTayang()
    {
        return $this->hasMany(JadwalTayang::class);
    }
}