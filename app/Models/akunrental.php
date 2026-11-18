<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AkunRental extends Model
{
    protected $table = 'akun_rental';
    protected $fillable = ['nama', 'nik', 'alamat', 'email', 'password', 'role'];
}