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
    public function show($id_user)
    {
        $transaksis = DB::table('transaksi')->where('id_user',$id_user)
        ->whereBetween('tgl_selesai', ['2019-01-01', '2019-12-31'])  
        ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
        ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
        ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
        ->join('master_acara', 'transaksi.nama_event', '=', 'master_acara.id')      
        ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'master_acara.nama_acara') 
        ->get();
        $nama_dinilai = DB::table('master_pegawai')->where('id', $id_user)->select('nama')->first();
        
        //Cek Posisi Penilai
        $ternilai = $id_user;
        $pp1 = DB::table('plot_penilai_dupak')->where('id_user_dinilai',  $id_user)->where('id_user_penilai_1', Auth::user()->id)->get();
        $pp2 = DB::table('plot_penilai_dupak')->where('id_user_dinilai',  $id_user)->where('id_user_penilai_2', Auth::user()->id)->get();
        
        $x = 0;
        if( count($pp1) == 1 AND count($pp2) == 0)
        {
            $x = 1;
        }
        if( count($pp1) == 0 AND count($pp2) == 1)
        {
            $x = 2;
        }
        return view('penilai.show', compact('transaksis', 'nama_dinilai', 'x'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDokdasar($id_user)
    {
        $dokdasar = DB::table('master_dok_wi')->where('id_user',$id_user)->first();
        $nama_dinilai = DB::table('master_pegawai')->where('id', $id_user)->select('nama')->first();
        //dd($dokdasar);
        return view('penilai.showdokdasar',compact('dokdasar', 'nama_dinilai'));
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

        //Cek Posisi Penilai
        $ternilai =  DB::table('transaksi')->where('id_transaksi',$id_transaksi)->select('id_user')->first();
        $pp1 = DB::table('plot_penilai_dupak')->where('id_user_dinilai', $ternilai->id_user)->where('id_user_penilai_1', Auth::user()->id)->get();
        $pp2 = DB::table('plot_penilai_dupak')->where('id_user_dinilai', $ternilai->id_user)->where('id_user_penilai_2', Auth::user()->id)->get();
        $x = 0;
        if( count($pp1) == 1 AND count($pp2) == 0)
        {
            $x = 1;
        }
        if( count($pp1) == 0 AND count($pp2) == 1)
        {
            $x = 2;
        }
        return view('penilai.edit', compact('transaksi', 'x'));
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
        $nama = DB::table('transaksi')->where('id_transaksi',$id_transaksi)->select('id_user')->first();
        
        //Cek Posisi Penilai
        $ternilai = $nama;
        $pp1 = DB::table('plot_penilai_dupak')->where('id_user_dinilai', $ternilai->id_user)->where('id_user_penilai_1', Auth::user()->id)->get();
        $pp2 = DB::table('plot_penilai_dupak')->where('id_user_dinilai',  $ternilai->id_user)->where('id_user_penilai_2', Auth::user()->id)->get();
        
        $x = 0;
        if( count($pp1) == 1 AND count($pp2) == 0)
        {
            $x = 1;
        }
        if( count($pp1) == 0 AND count($pp2) == 1)
        {
            $x = 2;
        }

        $transaksi = \App\Transaksi::find($id_transaksi);
        if($x == 1){
            if($transaksi){
                $transaksi->id_penilai1 = Auth::user()->id;
                $transaksi->status1 = $request->status1;
                $transaksi->angka_kredit1 = $request->angka_kredit1;
                $transaksi->ket_status1 = $request->keterangan1;
                $transaksi->save();
            }
        } 
        if($x == 2) {
            if($transaksi){
                $transaksi->id_penilai2 = Auth::user()->id;
                $transaksi->status2 = $request->status2;
                $transaksi->angka_kredit2 = $request->angka_kredit2;
                $transaksi->ket_status2 = $request->keterangan2;
                $transaksi->save();
            }
        }
        
        return redirect()->route('penilai.show', $nama->id_user)->with('success', 'Hasil Penilaian udpdated successfully');
    }

    public function dashboardPenilai()
    {
        $pen1 = DB::table ('plot_penilai_dupak')->where('id_user_penilai_1',  Auth::user()->id)
        ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')
        ->join('master_pegawai', 'plot_penilai_dupak.id_user_dinilai', '=', 'master_pegawai.id')
        ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])  //change then with flag
        ->select('transaksi.id_user', 'master_pegawai.nama',
            DB::raw('count(*) as total_kegiatan'), 
            DB::raw('sum(status1 = 2) setuju'),
            DB::raw('sum(status1 = 1) proses'),
            DB::raw('sum(status1 = 3) tolak'),
            DB::raw('sum(status1 = 4) pending'))           
        ->groupBy('transaksi.id_user')
        ->get();
        //dd($pen1);
        $pen2 = DB::table ('plot_penilai_dupak')->where('id_user_penilai_2',  Auth::user()->id)
        ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')
        ->join('master_pegawai', 'plot_penilai_dupak.id_user_dinilai', '=', 'master_pegawai.id')
        ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])  //change then with flag
        ->select('transaksi.id_user', 'master_pegawai.nama',
            DB::raw('count(*) as total_kegiatan'), 
            DB::raw('sum(status2 = 2) setuju'),
            DB::raw('sum(status2 = 1) proses'),
            DB::raw('sum(status2 = 3) tolak'),
            DB::raw('sum(status2 = 4) pending'))           
        ->groupBy('master_pegawai.nama')
        ->get();   
        //dd($pen2);     
        return view('penilai.dashboard', compact('pen1', 'pen2'));
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
