<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_kelamin',
        'usia',
        'pendidikan',
        'pekerjaan',
        'saran',
    ];
}
