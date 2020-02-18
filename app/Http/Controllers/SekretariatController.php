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
        $nama = DB::table('master_pegawai')->where('id', $id_user)->select('nama')->first();
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

        dd($result);
        return view('sekretariat.rekap2', compact('result', 'nama'));
    }

    public function bapak()
    {
        $result = array();
        $nama2 = DB::table('plot_penilai_dupak')
            ->join('master_pegawai', 'plot_penilai_dupak.id_user_dinilai','=', 'master_pegawai.id')
            ->join('master_jabatan', 'master_pegawai.jabatan', '=', 'master_jabatan.id')
            ->select(
                'plot_penilai_dupak.id_user_dinilai',
                'master_pegawai.nama',
                'master_pegawai.nip',
                'master_jabatan.nama_jabatan AS jabatan'
                )
            ->get();
        $temp_su = array();
        foreach ($nama2 as $ud) {
            $unsurutama = DB::table('master_unsur_utama')
            ->leftJoin('transaksi', function($join) use($ud) {
                    $join->on('master_unsur_utama.id', '=', 'transaksi.id_unsur_utama')                    
                        ->where('transaksi.id_user', '=', $ud->id_user_dinilai);
                    $join->on('tgl_selesai','>=',DB::raw("'2019-01-01'"));
                    $join->on('tgl_selesai','<=',DB::raw("'2019-12-31'"));
                })
            ->select('transaksi.id_unsur_utama',
                    DB::raw('COUNT(transaksi.id_transaksi) as jumlah_kegiatan'),
                    DB::raw('SUM(transaksi.angka_kredit_usul) as angka_kredit'),
                    DB::raw('SUM((CASE WHEN transaksi.status1 = 2 THEN transaksi.angka_kredit1 END)) AS ak1'),
                    DB::raw('SUM((CASE WHEN transaksi.status2 = 2 THEN transaksi.angka_kredit2 END)) AS ak2'))
            ->groupBy('master_unsur_utama.id')
            ->get();
            $temp_keg = array('id_user' => $ud->id_user_dinilai, 'kegiatans' => json_decode(json_encode($unsurutama), true));
            array_push($temp_su, $temp_keg);
        }
        dd($temp_su);
        //return view('sekretariat.bapak', compact('result'));
    }


    public function rekap3()
    {
        $rekap3 = DB::table('plot_penilai_dupak')
        ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')        
        ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai') 
        ->join('master_pegawai AS B', 'B.id', 'plot_penilai_dupak.id_user_penilai_1')
        ->join('master_pegawai AS C', 'C.id', 'plot_penilai_dupak.id_user_penilai_2')       
        ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=','master_rincian_kegiatan.id_rincian_kegiatan')
        ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])
        ->where('transaksi.status1', '=', '4')
        ->orWhere('transaksi.status2', '=', '4')
        ->select('transaksi.id_transaksi','transaksi.id_user', 'A.nama as user_dinilai', 'transaksi.status1', 'transaksi.status2', 'master_rincian_kegiatan.rincian_kegiatan', 'transaksi.keterangan', 'B.nama as penilai1', 'transaksi.ket_status1', 'C.nama as penilai2', 'transaksi.ket_status2')
        ->get();
        //dd($rekap3);
        return view('sekretariat.rekap3', compact('rekap3'));
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
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_transaksi)
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi',$id_transaksi)
        ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')        
        ->join('master_pegawai AS A', 'A.id', 'transaksi.id_user') 
        ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
        ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
        ->join('master_acara', 'transaksi.nama_event', '=', 'master_acara.id')     
        ->join('master_rincian_angka_kredit', 'transaksi.id_rinci_ak', '=', 'master_rincian_angka_kredit.id_rinci_ak')    
        ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'master_acara.nama_acara', 'master_rincian_angka_kredit.angka_kredit', 'A.nama as user_dinilai') 
        ->first();
        $unsurutamas = DB::table("master_unsur_utama")->pluck( 'unsur_utama', 'id');
        $nama_acaras = DB::table("master_acara")->pluck('nama_acara', 'id');
        //dd($transaksi);
        return view('sekretariat.rekap3rinci', compact('transaksi', 'unsurutamas', 'nama_acaras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
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
