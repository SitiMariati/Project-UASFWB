<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Model
{
 use HasFactory,Notifiable;

 protected $fillable = [
    'nama',
    'email',
    'password',
    'role',
 ];

 public function pesanan()
 {
    return $this->hasMany(Pemesanan::class);
 }
}
