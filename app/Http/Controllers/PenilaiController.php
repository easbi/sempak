<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use DB;
use Auth;


class PenilaiController extends Controller
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
        $user = Auth::user()->id;
        $transaksis = DB::table('transaksi')
            ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
            ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
            ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
            ->join('master_acara', 'transaksi.nama_event', '=', 'master_acara.id')      
            ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'master_acara.nama_acara')   
            ->where('id_user', Auth::user()->id)
            ->orderby('id_transaksi','asc')
            ->get();
        return view('penilai.index', compact('transaksis'));
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
    public function edit($id_transaksi)
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi',$id_transaksi)
        ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
        ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
        ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
        ->join('master_acara', 'transaksi.nama_event', '=', 'master_acara.id')      
        ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'master_acara.nama_acara') 
        ->get();
        //dd($transaksi);
        return view('penilai.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_transaksi)
    {
        //$transaksi = DB::table('transaksi')->where('id_transaksi',$id_transaksi)->first();
        $transaksi = \App\Transaksi::find($id_transaksi);
        if($transaksi) {
            $transaksi->status1 = $request->status1;
            $transaksi->angka_kredit1 = $request->angka_kredit1;
            $transaksi->ket_status1 = $request->keterangan1;

            $transaksi->save();
        }
        return redirect()->route('penilai.index')->with('success', 'Hasil Penilaian udpdated successfully');
    }

    public function dashboardPenilai()
    {
        #status dupak user
        $proses_total = DB::table ('transaksi')->where('id_user', Auth::user()->id)->count();
        $proses_11 = DB::table ('transaksi')->select('status1')->where('status1', 1)->where('id_user', Auth::user()->id)->count();
        $proses_12 = DB::table ('transaksi')->select('status1')->where('status1', 2)->where('id_user', Auth::user()->id)->count();        
        $proses_13 = DB::table ('transaksi')->select('status1')->where('status1', 3)->where('id_user', Auth::user()->id)->count();

        #status dupak user
        $userp1 = DB::table('plot_penilai_dupak')->select('id_user_dinilai')->where('id_user_penilai_1', Auth::user()->id)->get();
        $userp2 = DB::table('plot_penilai_dupak')->select('id_user_dinilai')->where('id_user_penilai_2', Auth::user()->id)->count();
        //$penilai_total = DB::table('transaksi')->whereIn('id_user_penilai_1', $userp1)->get();
        //dd(get_object_vars($userp1));
        return view('penilai.dashboard', compact('proses_11', 'proses_12', 'proses_13', 'proses_total'));
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
