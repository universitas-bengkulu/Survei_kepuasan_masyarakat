<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'username',
        'nama_lengkap',
        'akses',
        'prodi',
        'fakultas',
        'indikator_id',
        'nama_indikator',
        'skor',
        'created_at',
        'updated_at'
    ];
}
