<?php

namespace App\Http\Controllers;

use App\Plotpenilai;
use Illuminate\Http\Request;
use DB;
use Auth;

class PlotpenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plotpenilais = DB::table('plot_penilai_dupak')
        ->leftjoin('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->leftjoin('master_pegawai AS B', 'B.id', 'plot_penilai_dupak.id_user_penilai_1')
        ->leftjoin('master_pegawai AS C', 'C.id', 'plot_penilai_dupak.id_user_penilai_2')
        ->select('plot_penilai_dupak.*', 'A.nama as user_dinilai', 'B.nama as penilai1', 'C.nama as penilai2')
        ->get();//dd($plotpenilais);
        
        return view('plotpenilai.index', compact('plotpenilais'));
    }

    public function getPeriodePengusul()
    {
        $periodePengusul = DB::table('plot_penilai_dupak')
        ->where('id_user_dinilai' , Auth::user()->id)
        ->leftjoin('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->select('plot_penilai_dupak.*', 'A.nama as user_dinilai')
        ->get();

        return view('plotpenilai.indexDariPengusul', compact('periodePengusul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $namas = DB::table("master_pegawai")->pluck( 'nama', 'id');
        return view('plotpenilai.create', compact('namas'));
    }

    public function createDariPengusul()
    {
        $periodePengusul = DB::table('plot_penilai_dupak')
        ->where('id_user_dinilai' , Auth::user()->id)
        ->leftjoin('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->select('plot_penilai_dupak.*', 'A.nama as user_dinilai')
        ->get();

        $temp = count($periodePengusul);
        // dd($temp);
        if ($temp != 0) {
            return redirect('/home');
        } else {
            return view('plotpenilai.createDariPengusul');            
        }        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_penilai_1 = $request->user_penilai_1;
        $id_penilai_2 = $request->user_penilai_2;

        if ($request->user_penilai_1 == NULL) {
            $id_penilai_1 = 1;
        }
        if ($request->user_penilai_2 == NULL) {
            $id_penilai_2 = 1;
        }
        Plotpenilai::create([
                'id_user_dinilai' => $request->user_dinilai,
                'id_user_penilai_1' => $id_penilai_1,
                'id_user_penilai_2' => $id_penilai_2,
                'p_awal' => $request->p_awal,
                'p_akhir' => $request->p_akhir
            ]);
        if (Auth::user()->role == 1 OR  Auth::user()->role == 4 OR Auth::user()->role == 5) {
            return redirect('/plotpenilai');
        } else {
            return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function show(Plotpenilai $plotpenilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //$plotpenilai = \App\Plotpenilai::find($id);
        $plotpenilais = DB::table('plot_penilai_dupak')
        ->leftjoin('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->leftjoin('master_pegawai AS B', 'B.id', 'plot_penilai_dupak.id_user_penilai_1')
        ->leftjoin('master_pegawai AS C', 'C.id', 'plot_penilai_dupak.id_user_penilai_2')
        ->select('plot_penilai_dupak.*', 'A.nama as user_dinilai', 'B.nama as penilai1', 'C.nama as penilai2')
        ->where('plot_penilai_dupak.id', $id)
        ->first();
        //dd($plotpenilais);
        $id_n = $id;
        $namas = DB::table("master_pegawai")->pluck( 'nama', 'id');
        return view('plotpenilai.edit', compact('namas', 'id_n', 'plotpenilais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plotpenilai = \App\Plotpenilai::find($id);
        if($plotpenilai) {
            $plotpenilai->id_user_dinilai = $request->user_dinilai;
            $plotpenilai->id_user_penilai_1 = $request->user_penilai_1;
            $plotpenilai->id_user_penilai_2 = $request->user_penilai_2;
            $plotpenilai->p_awal = $request->p_awal;
            $plotpenilai->p_akhir = $request->p_akhir;
            $plotpenilai->save();
        }
        return redirect()->route('plotpenilai.index')->with('success', 'Hasil Plot Penilai udpdated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plotpenilai $plotpenilai)
    {
        $plotpenilai->delete();  
        return redirect()->route('plotpenilai.index')->with('success','Acara deleted successfully');
    }
}
