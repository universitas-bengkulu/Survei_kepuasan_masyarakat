<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\EvaluasiRekap;
use App\Models\Indikator;
use App\Models\Saran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('isMahasiswa');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $indikators = Indikator::where('ditampilkan',true)->get();
        return view('welcome',compact('indikators'));
    }

    public function post(Request $request){
        // DB::beginTransaction();
        // try {
            $jumlah = $request->jumlah;
            $data = Indikator::where('ditampilkan',1)->get();
            $kuisioner = array();
            foreach ($data as $data) {
                $kuisioner [] =  array(
                    'jenis_kelamin'	    =>  $request->jenis_kelamin,

                    'usia'              =>  $request->usia,
                    'pendidikan'        =>  $request->pendidikan,
                    'pekerjaan'         =>  $request->pekerjaan,
                    'indikator_id'	    =>  $data->id,
                    'nama_indikator'	=>  $data->nama_indikator,
                    'skor'              =>  $_POST['nilai'.$data->id],
                    'created_at'        =>  Carbon::now(),
                    'updated_at'        =>  Carbon::now(),
                );
            }

            Evaluasi::insert($kuisioner);
            $total =  array_sum(array_column($kuisioner, 'skor'));
            $rata = $total/$jumlah;
            EvaluasiRekap::create([
                'jenis_kelamin'              => $request->jenis_kelamin,
                'usia'                       => $request->usia,
                'pendidikan'                 => $request->pendidikan,
                'pekerjaan'                  => $request->pekerjaan,
                'total_skor'                 => $total,
                'rata_rata'                  => $rata,
            ]);
            if (!$request->saran == null && !$request->saran == "") {
                Saran::create([
                    'jenis_kelamin'	        =>  $request->jenis_kelamin,
                    'usia'                  =>  $request->usia,
                    'pendidikan'            =>  $request->pendidikan,
                    'pekerjaan'             =>  $request->pekerjaan,
                    'saran'                 =>  $request->saran,
                ]);
            }
            // DB::commit();
            $notification = array(
                'message' => 'Kuisioner berhasil disimpan!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        // }
        //  catch (\Exception $e) {
        //     DB::rollback();
        //     $notification = array(
        //         'message' => 'Kuisioner gagal disimpan!',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->back()->with($notification);
        // }
    }
}
