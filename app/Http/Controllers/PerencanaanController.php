<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiRekap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerencanaanController extends Controller
{
    public function dashboard(){
        $jumlah = EvaluasiRekap::select('fakultas',DB::raw('count(fakultas) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('fakultas')->orderBy('fakultas')->get();
        $evaluasi = EvaluasiRekap::all()->count();
        $today = EvaluasiRekap::whereDate('created_at', Carbon::today())->get()->count();
        $rata_rata = EvaluasiRekap::select(DB::raw('sum(rata_rata)/"'.$evaluasi.'" as skor'))->first();
        $rata_rata_today = EvaluasiRekap::select(DB::raw('sum(rata_rata)/"'.$today.'" as skor'))->whereDate('created_at', Carbon::today())->first();
        return view('perencanaan.dashboard',[
            'evaluasi' => $evaluasi,
            'today' => $today,
            'rata_rata' => $rata_rata,
            'rata_rata_today' => $rata_rata_today,
            'jumlah' => $jumlah,
        ]);
    }
}
