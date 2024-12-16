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
        $jumlah = EvaluasiRekap::select('pekerjaan','pendidikan',DB::raw('count(pekerjaan) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('pekerjaan')->orderBy('pendidikan')->get();
        return view('operator/laporan.per_prodi',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function perFakultas(){
        $jumlah = EvaluasiRekap::select('pendidikan',DB::raw('count(pendidikan) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('pendidikan')->orderBy('pendidikan')->get();
        return view('operator/laporan.per_fakultas',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function keseluruhan(){
        $jumlah = EvaluasiRekap::select('pendidikan','pekerjaan','nama_lengkap','akses','total_skor','rata_rata','created_at')->orderBy('pendidikan')->orderBy('pekerjaan')->get();
        return view('operator/laporan.keseluruhan',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function saran(){
        $sarans = Saran::select('pendidikan','pekerjaan','nama_lengkap','akses','saran','created_at')->orderBy('pendidikan')->orderBy('pekerjaan')->orderBy('created_at','desc')->get();
        return view('operator/laporan.saran',[
            'sarans'    => $sarans,
        ]);
    }
}
