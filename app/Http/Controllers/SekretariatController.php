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
            DB::raw('SUM((CASE WHEN status1 = 2 THEN angka_kredit1 END)) AS total_ak_1'),
            DB::raw('SUM((CASE WHEN status2 = 2 THEN angka_kredit2 END)) AS total_ak_2'))      
        ->groupBy('transaksi.id_user')
        ->get();

        return view('sekretariat.rekap1', compact('rekap1'));
    }

    public function rekap2($id_user)
    {
        $result = array();
        $jabatan = DB::table('master_pegawai')->where('id', $id_user)->select('jabatan')->first();
        $unsurutamas = DB::table('master_unsur_utama')->select('id','unsur_utama')->get();
        foreach($unsurutamas as $uu) {
            $subunsurs = DB::table('master_subunsurs')->select('id_sub_unsur','kegiatan_sub_unsur')->where('id_unsur',$uu->id)->get();
            $temp_su = array();
            foreach($subunsurs as $su) {
                $kegiatans = DB::table('master_rincian_kegiatan')
                ->leftJoin('transaksi','master_rincian_kegiatan.id_rincian_kegiatan','=',DB::raw('transaksi.id_rincian_kegiatan AND transaksi.id_user='.$id_user.' AND transaksi.tgl_selesai BETWEEN cast("2019-01-01" as date) AND cast("2019-12-31" as date)'))
                ->join('master_rincian_angka_kredit','master_rincian_kegiatan.id_rincian_kegiatan','=',DB::raw('master_rincian_angka_kredit.id_rincian_kegiatan AND master_rincian_angka_kredit.id_tingkatan_wi='.$jabatan->jabatan))
                ->select('master_rincian_angka_kredit.kk','rincian_kegiatan',DB::raw('COUNT(transaksi.id_transaksi) as jumlah_kegiatan'),
                    DB::raw('SUM(transaksi.angka_kredit_usul) as angka_kredit'),
                    DB::raw('SUM((CASE WHEN transaksi.status1 = 2 THEN transaksi.angka_kredit1 END)) AS ak1'),
                    DB::raw('SUM((CASE WHEN transaksi.status2 = 2 THEN transaksi.angka_kredit2 END)) AS ak2'))
                ->where('master_rincian_kegiatan.id_subunsur',$su->id_sub_unsur)
                ->groupBy('master_rincian_kegiatan.rincian_kegiatan')
                ->groupBy('master_rincian_angka_kredit.kk')
                ->orderBy('master_rincian_angka_kredit.kk','asc')
                ->get();
                $temp_keg = array('id_su' => $su->id_sub_unsur, 'su' => $su->kegiatan_sub_unsur, 'kegiatans' => json_decode(json_encode($kegiatans), true));
                array_push($temp_su, $temp_keg);
        }
            $temp_uu = array('id_uu' => $uu->id, 'unsur' => $uu->unsur_utama, 'sub_unsurs' => $temp_su);
            array_push($result, $temp_uu);
        }

        //dd($result);
        return view('sekretariat.rekap2', compact('result'));
    }


    public function rekap3()
    {
        $rekap1 = DB::table('plot_penilai_dupak')
        ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')        
        ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])
        ->where('transaksi.status1')
        ->select('transaksi.id_user', 'A.nama as user_dinilai', 'transaksi.status1')    
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
