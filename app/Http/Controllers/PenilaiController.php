<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use DB;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;


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
        $p_awal = DB::table('plot_penilai_dupak')->where('id_user_dinilai', $id_user)->select('p_awal')->first();
        $p_akhir = DB::table('plot_penilai_dupak')->where('id_user_dinilai', $id_user)->select('p_akhir')->first();
        $transaksis = DB::table('transaksi')->where('transaksi.id_user',$id_user)
        ->whereBetween('tgl_selesai', [ $p_awal->p_awal, $p_akhir->p_akhir])  //ganti
        ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
        ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
        ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')
        ->join('transaksi_dok_spmk_stmk', 'transaksi.nama_event', '=', 'transaksi_dok_spmk_stmk.id')
        ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'transaksi_dok_spmk_stmk.acara') 
        ->get();
        $nama_dinilai = DB::table('master_pegawai')->where('id', $id_user)->select('nama')->first();
        // dd($transaksis);

        //start belajar <--> array ini tidak digunakan , hanya utk belajar saja
        //cari tahu yg dinilai ada berapa dan isinya
        //request untuk masing2 yg dinilai
        //hasilnya dimasukin ke 1 array
        $pen1c = DB::table ('plot_penilai_dupak')->where('id_user_dinilai', $id_user)->get();
        $transaksis2=collect(); 
        foreach ($pen1c as $x) {
            $ppd = DB::table('transaksi')->where('transaksi.id_user', $id_user)
            ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
            ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
            ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')
            ->join('transaksi_dok_spmk_stmk', 'transaksi.nama_event', '=', 'transaksi_dok_spmk_stmk.id')
            ->whereBetween('tgl_selesai', [date($x->p_awal), date($x->p_akhir)])
            ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'transaksi_dok_spmk_stmk.acara') 
            ->get();
            $transaksis2->push($ppd);
        }
        $transaksis2 = json_decode($transaksis2); 
        // dd($transaksis2);
        // dd($transaksis2[0][1]->id_user); //end belajar <--> hanya sampai disini belajarnya
        
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
        ->join('transaksi_dok_spmk_stmk', 'transaksi.nama_event', '=', 'transaksi_dok_spmk_stmk.id')      
        ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'transaksi_dok_spmk_stmk.acara', 'transaksi_dok_spmk_stmk.spmt_berkas', 'transaksi_dok_spmk_stmk.spmt_url','transaksi_dok_spmk_stmk.stmt_berkas','transaksi_dok_spmk_stmk.stmt_url') 
        ->get();
        // dd($transaksi);
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
        //cari tahu yg dinilai ada berapa dan isinya
        //request untuk masing2 yg dinilai
        //hasilnya dimasukin ke 1 array
        $pen1c = DB::table ('plot_penilai_dupak')->where('id_user_penilai_1',  Auth::user()->id)->get();
        //create array temporary
        $pen1=collect();
        foreach ($pen1c as $x) {
            $ppd = DB::table('transaksi')->where('id_user', $x->id_user_dinilai)            
            ->join('master_pegawai', 'transaksi.id_user', '=', 'master_pegawai.id')
            ->whereBetween('tgl_selesai', [date($x->p_awal), date($x->p_akhir)])
            ->select('id_user', 'master_pegawai.nama',
                DB::raw('count(*) as total_kegiatan'), 
                DB::raw('sum(status2 = 2) setuju'),
                DB::raw('sum(status2 = 1) proses'),
                DB::raw('sum(status2 = 3) tolak'),
                DB::raw('sum(status2 = 4) pending'))           
            ->groupBy('master_pegawai.nama')
            ->get();
            $pen1->push($ppd);
         }
         // $pen1=json_decode($pen1);
         // dd($pen1[0][0]->nama); //langkah akses indeks aray
        $pen2c = DB::table ('plot_penilai_dupak')->where('id_user_penilai_2',  Auth::user()->id)->get();
        $pen2 = collect();
        foreach ($pen2c as $x) {
            $ppd = DB::table('transaksi')->where('id_user', $x->id_user_dinilai)
            ->join('master_pegawai', 'transaksi.id_user', '=', 'master_pegawai.id')
            ->whereBetween('tgl_selesai', [date($x->p_awal), date($x->p_akhir)])
            ->select('id_user', 'master_pegawai.nama',
                DB::raw('count(*) as total_kegiatan'), 
                DB::raw('sum(status2 = 2) setuju'),
                DB::raw('sum(status2 = 1) proses'),
                DB::raw('sum(status2 = 3) tolak'),
                DB::raw('sum(status2 = 4) pending'))           
            ->groupBy('master_pegawai.nama')
            ->get();
            $pen2->push($ppd);

        }
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
