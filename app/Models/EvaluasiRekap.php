<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiRekap extends Model
{
    use HasFactory;
    protected $fillable = [
        'username','nama_lengkap','akses','prodi','fakultas','total_skor','rata_rata'
    ];
}
