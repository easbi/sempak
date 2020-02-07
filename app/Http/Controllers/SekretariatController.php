<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use DB;
use Auth;

class SekretariatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plotpenilais = DB::table('plot_penilai_dupak')
        ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')
        ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->join('master_pegawai AS B', 'B.id', 'plot_penilai_dupak.id_user_penilai_1')
        ->join('master_pegawai AS C', 'C.id', 'plot_penilai_dupak.id_user_penilai_2')
        ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])
        ->select('transaksi.id_user', 'A.nama as user_dinilai', 'B.nama as user_penilai1', 'C.nama as user_penilai2',
            DB::raw('count(*) as total_kegiatan'), 
            DB::raw('sum(status1 = 2) setuju1'),
            DB::raw('sum(status1 = 1) proses1'),
            DB::raw('sum(status1 = 3) tolak1'),
            DB::raw('sum(status1 = 4) pending1'),
            DB::raw('sum(status2 = 2) setuju2'),
            DB::raw('sum(status2 = 1) proses2'),
            DB::raw('sum(status2 = 3) tolak2'),
            DB::raw('sum(status2 = 4) pending2'))           
        ->groupBy('transaksi.id_user')
        ->get();
        //dd($plotpenilais);
        return view('sekretariat.index', compact('plotpenilais'));
    }

    public function rekap1()
    {
        $rekap1 = DB::table('plot_penilai_dupak')
        ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')        
        ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])
        ->select('transaksi.id_user', 'A.nama as user_dinilai',
            DB::raw('count(*) as total_kegiatan'), 
            DB::raw('sum(angka_kredit_usul) total_ak_usul'),
            DB::raw('sum(angka_kredit1) total_ak_1'),
            DB::raw('sum(angka_kredit2) total_ak_2'))         
        ->groupBy('transaksi.id_user')
        ->get();

        return view('sekretariat.rekap1', compact('rekap1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
