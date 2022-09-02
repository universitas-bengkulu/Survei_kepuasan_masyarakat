<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiRekap;
use App\Models\Indikator;
use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function perProdi(){
        $jumlah = EvaluasiRekap::select('prodi','fakultas',DB::raw('count(prodi) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('prodi')->orderBy('fakultas')->get();
        return view('operator/laporan.per_prodi',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function perFakultas(){
        $jumlah = EvaluasiRekap::select('fakultas',DB::raw('count(fakultas) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('fakultas')->orderBy('fakultas')->get();
        return view('operator/laporan.per_fakultas',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function keseluruhan(){
        $jumlah = EvaluasiRekap::select('fakultas','prodi','nama_lengkap','akses','total_skor','rata_rata','created_at')->orderBy('fakultas')->orderBy('prodi')->get();
        return view('operator/laporan.keseluruhan',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function saran(){
        $sarans = Saran::select('fakultas','prodi','nama_lengkap','akses','saran','created_at')->orderBy('fakultas')->orderBy('prodi')->orderBy('created_at','desc')->get();
        return view('operator/laporan.saran',[
            'sarans'    => $sarans,
        ]);
    }
}
