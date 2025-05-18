<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';

    protected $fillable = ['nama', 'email', 'password', 'role'];

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'pengguna_id');
    }

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_pengguna');
    }

    public function pesanan()
    {
        return $this->hasManyThrough(Pesanan::class, UserProfile::class, 'pengguna_id', 'user_profiles_id');
    }
}
