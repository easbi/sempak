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
        // $plotpenilais = DB::table('plot_penilai_dupak')
        // ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')
        // ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        // ->join('master_pegawai AS B', 'B.id', 'plot_penilai_dupak.id_user_penilai_1')
        // ->join('master_pegawai AS C', 'C.id', 'plot_penilai_dupak.id_user_penilai_2')
        // ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])
        // ->select('transaksi.id_user', 'A.nama as user_dinilai', 'B.nama as user_penilai1', 'C.nama as user_penilai2',
        //     DB::raw('count(*) as total_kegiatan'), 
        //     DB::raw('sum(status1 = 2) setuju1'),
        //     DB::raw('sum(status1 = 1) proses1'),
        //     DB::raw('sum(status1 = 3) tolak1'),
        //     DB::raw('sum(status1 = 4) pending1'),
        //     DB::raw('sum(status2 = 2) setuju2'),
        //     DB::raw('sum(status2 = 1) proses2'),
        //     DB::raw('sum(status2 = 3) tolak2'),
        //     DB::raw('sum(status2 = 4) pending2'))           
        // ->groupBy('transaksi.id_user')
        // ->get();   ->join('master_pegawai', 'transaksi.id_user', '=', 'master_pegawai.id')

        
        $pen1c = DB::table ('plot_penilai_dupak')
        ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->join('master_pegawai AS B', 'B.id', 'plot_penilai_dupak.id_user_penilai_1')
        ->join('master_pegawai AS C', 'C.id', 'plot_penilai_dupak.id_user_penilai_2')
        ->select('plot_penilai_dupak.*', 'A.nama as user_dinilai', 'B.nama as user_penilai1', 'C.nama as user_penilai2')
        ->get();
        // dd($pen1c);

        $plotpenilais=collect();
        foreach ($pen1c as $x) {
            $ppd = DB::table('transaksi')->where('id_user', $x->id_user_dinilai)
            ->whereBetween('tgl_selesai', [date($x->p_awal), date($x->p_akhir)])          
            ->join('master_pegawai', 'transaksi.id_user', '=', 'master_pegawai.id') 
            ->select('transaksi.id_user', 'master_pegawai.nama',
                DB::raw('count(*) as total_kegiatan'), 
                DB::raw('sum(status1 = 2) setuju1'),
                DB::raw('sum(status1 = 1) proses1'),
                DB::raw('sum(status1 = 3) tolak1'),
                DB::raw('sum(status1 = 4) pending1'),
                DB::raw('sum(status2 = 2) setuju2'),
                DB::raw('sum(status2 = 1) proses2'),
                DB::raw('sum(status2 = 3) tolak2'),
                DB::raw('sum(status2 = 4) pending2'))           
            ->groupBy('master_pegawai.nama')
            ->get();
            $plotpenilais->push(json_decode($ppd));
         }
         $plotpenilais = $plotpenilais->toArray();
         $pen1c =$pen1c->toArray();
         // dd($pen1c);
          // $plotpenilais = json_encode($plotpenilais);
         // dd($plotpenilais);
         // dd($plotpenilais[0][0]->id_user);
        return view('sekretariat.index', compact('plotpenilais', 'pen1c'));
    }

    public function rekap1()
    {
        // $rekap1 = DB::table('plot_penilai_dupak')
        // ->join('transaksi', 'plot_penilai_dupak.id_user_dinilai', '=', 'transaksi.id_user')        
        // ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        // ->whereBetween('transaksi.tgl_selesai', ['2019-01-01', '2019-12-31'])
        // ->select('transaksi.id_user', 'A.nama as user_dinilai',
        //     DB::raw('count(*) as total_kegiatan'), 
        //     DB::raw('sum(angka_kredit_usul) total_ak_usul'),
        //     DB::raw('SUM((CASE WHEN status1 = 2 THEN angka_kredit1 END)) AS total_ak_1'),
        //     DB::raw('SUM((CASE WHEN status2 = 2 THEN angka_kredit2 END)) AS total_ak_2'))      
        // ->groupBy('transaksi.id_user')
        // ->get();
        $pen1c = DB::table ('plot_penilai_dupak')
        ->join('master_pegawai AS A', 'A.id', 'plot_penilai_dupak.id_user_dinilai')
        ->join('master_pegawai AS B', 'B.id', 'plot_penilai_dupak.id_user_penilai_1')
        ->join('master_pegawai AS C', 'C.id', 'plot_penilai_dupak.id_user_penilai_2')
        ->select('plot_penilai_dupak.*', 'A.nama as user_dinilai', 'B.nama as user_penilai1', 'C.nama as user_penilai2')
        ->get();
        // dd($pen1c);

        $rekap1=collect();
        foreach ($pen1c as $x) {
            $ppd = DB::table('transaksi')->where('id_user', $x->id_user_dinilai)
            ->whereBetween('tgl_selesai', [date($x->p_awal), date($x->p_akhir)])          
            ->join('master_pegawai', 'transaksi.id_user', '=', 'master_pegawai.id') 
            ->select('transaksi.id_user', 'master_pegawai.nama',
                DB::raw('count(*) as total_kegiatan'), 
                DB::raw('sum(angka_kredit_usul) total_ak_usul'),
                DB::raw('SUM((CASE WHEN status1 = 2 THEN angka_kredit1 END)) AS total_ak_1'),
                DB::raw('SUM((CASE WHEN status2 = 2 THEN angka_kredit2 END)) AS total_ak_2'))          
            ->groupBy('master_pegawai.nama')
            ->get();
            $rekap1->push(json_decode($ppd));
         }
         $rekap1 = $rekap1->toArray();
         $pen1c =$pen1c->toArray();
         // dd($rekap1);
        return view('sekretariat.rekap1', compact('rekap1', 'pen1c'));
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
        //dd($result);
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
                    'master_unsur_utama.unsur_utama',
                    'master_unsur_utama.kode',
                    DB::raw('COUNT(transaksi.id_transaksi) as jumlah_kegiatan'),
                    DB::raw('SUM(transaksi.angka_kredit_usul) as ak_usul'),
                    DB::raw('SUM((CASE WHEN transaksi.status1 = 2 THEN transaksi.angka_kredit1 END)) AS ak1'),
                    DB::raw('SUM((CASE WHEN transaksi.status2 = 2 THEN transaksi.angka_kredit2 END)) AS ak2'))
            ->groupBy('master_unsur_utama.id')
            ->get();

            $t_akusul = 0;
            $t_ak1 = 0;
            $t_ak2 = 0;
            $u_akusul = 0;
            $u_ak1 = 0;
            $u_ak2 = 0;
            $array1lagi = array();

            foreach ($unsurutama as $ut) {
                $t_akusul = $t_akusul + $ut->ak_usul;
                $t_ak1 = $t_ak1 + $ut->ak1;
                if($ut->kode != "P"){
                    $u_akusul = $u_akusul + $ut->ak_usul;
                    $u_ak1 = $u_ak1 + $ut->ak1;
                }
            }
            array_push($array1lagi, array('kode'=>"T", 'usul'=>$t_akusul, 'ak'=>$t_ak1));
            array_push($array1lagi, array('kode'=>"U", 'usul'=>$u_akusul, 'ak'=>$u_ak1));

            $temp_keg = array('id_user' => $ud->id_user_dinilai,
                'nama' => $ud->nama,
                'nip' => $ud->nip,
                'jabatan'=> $ud->jabatan,
                'array1lagi' => $array1lagi,
                'kegiatans' => json_decode(json_encode($unsurutama), true));
            array_push($temp_su, $temp_keg);
        }
        //dd($temp_su);
        return view('sekretariat.bapak', compact('temp_su'));
    }

    public function eksporbapak()
    {
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
                    'master_unsur_utama.unsur_utama',
                    'master_unsur_utama.kode',
                    DB::raw('COUNT(transaksi.id_transaksi) as jumlah_kegiatan'),
                    DB::raw('SUM(transaksi.angka_kredit_usul) as ak_usul'),
                    DB::raw('SUM((CASE WHEN transaksi.status1 = 2 THEN transaksi.angka_kredit1 END)) AS ak1'),
                    DB::raw('SUM((CASE WHEN transaksi.status2 = 2 THEN transaksi.angka_kredit2 END)) AS ak2'))
            ->groupBy('master_unsur_utama.id')
            ->get();

            $t_akusul = 0;
            $t_ak1 = 0;
            $t_ak2 = 0;
            $u_akusul = 0;
            $u_ak1 = 0;
            $u_ak2 = 0;
            $array1lagi = array();

            foreach ($unsurutama as $ut) {
                $t_akusul = $t_akusul + $ut->ak_usul;
                $t_ak1 = $t_ak1 + $ut->ak1;
                if($ut->kode != "P"){
                    $u_akusul = $u_akusul + $ut->ak_usul;
                    $u_ak1 = $u_ak1 + $ut->ak1;
                }
            }
            array_push($array1lagi, array('kode'=>"T", 'usul'=>$t_akusul, 'ak'=>$t_ak1));
            array_push($array1lagi, array('kode'=>"U", 'usul'=>$u_akusul, 'ak'=>$u_ak1));

            $temp_keg = array('id_user' => $ud->id_user_dinilai,
                'nama' => $ud->nama,
                'nip' => $ud->nip,
                'jabatan'=> $ud->jabatan,
                'array1lagi' => $array1lagi,
                'kegiatans' => json_decode(json_encode($unsurutama), true));
            array_push($temp_su, $temp_keg);
        }

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('template_bapak.xlsx'));
        $worksheet = $reader->getActiveSheet();

        $r = 8;
        foreach ($temp_su as $us){
            $s = 0;
            foreach ($us['array1lagi'] as $al) {
                if($s == 0) {
                    $worksheet->setCellValue('B'.$r, $us['id_user']);
                    $worksheet->setCellValue('C'.$r, $us['nama']);
                    $worksheet->setCellValue('D'.$r, $us['jabatan']);
                    $worksheet->setCellValue('E'.$r, 0);
                } else {
                    $worksheet->setCellValue('B'.$r, '');
                    $worksheet->setCellValue('C'.$r, '');
                    $worksheet->setCellValue('D'.$r, '');
                    $worksheet->setCellValue('E'.$r, '');
                }
                $worksheet->setCellValue('F'.$r, $al['kode']);
                $worksheet->setCellValue('G'.$r, '');
                $worksheet->setCellValue('H'.$r, $al['kode']);
                $worksheet->setCellValue('I'.$r, '');
                $worksheet->setCellValue('J'.$r, $al['kode']);
                $worksheet->setCellValue('K'.$r, number_format($al['usul'], 3, ",","."));
                $worksheet->setCellValue('L'.$r, $al['kode']);
                $worksheet->setCellValue('M'.$r, number_format($al['ak'], 3, ",","."));
                $worksheet->setCellValue('N'.$r, $al['kode']);
                $worksheet->setCellValue('O'.$r, '');
                $worksheet->setCellValue('P'.$r, $al['kode']);
                $worksheet->setCellValue('Q'.$r, '');
                $worksheet->setCellValue('R'.$r, '');
                $worksheet->setCellValue('S'.$r, '');
                $worksheet->setCellValue('T'.$r, '');
                $r++;
                $s++;
            }
            foreach ($us['kegiatans'] as $al) {
                $worksheet->setCellValue('B'.$r, '');
                $worksheet->setCellValue('C'.$r, '');
                $worksheet->setCellValue('D'.$r, '');
                $worksheet->setCellValue('E'.$r, '');
                $worksheet->setCellValue('F'.$r, $al['kode']);
                $worksheet->setCellValue('G'.$r, '');
                $worksheet->setCellValue('H'.$r, $al['kode']);
                $worksheet->setCellValue('I'.$r, '');
                $worksheet->setCellValue('J'.$r, $al['kode']);
                $worksheet->setCellValue('K'.$r, number_format($al['ak_usul'], 3, ",","."));
                $worksheet->setCellValue('L'.$r, $al['kode']);
                $worksheet->setCellValue('M'.$r, number_format($al['ak1'], 3, ",","."));
                $worksheet->setCellValue('N'.$r, $al['kode']);
                $worksheet->setCellValue('O'.$r, '');
                $worksheet->setCellValue('P'.$r, $al['kode']);
                $worksheet->setCellValue('Q'.$r, '');
                $worksheet->setCellValue('R'.$r, '');
                $worksheet->setCellValue('S'.$r, '');
                $worksheet->setCellValue('T'.$r, '');
                $r++;
            }
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($reader);
        $writer->save(storage_path('result_bapak.xlsx'));

        return response()->download(storage_path('result_bapak.xlsx'));
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
