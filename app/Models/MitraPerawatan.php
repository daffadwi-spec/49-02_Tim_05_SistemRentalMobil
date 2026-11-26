<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraPerawatan extends Model
{
    protected $table = 'mitra_perawatans';
    protected $fillable = ['nama_layanan'];
}