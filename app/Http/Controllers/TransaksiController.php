<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Transaksi;
use DB;
use Auth;

class TransaksiController extends Controller
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
        $transaksis = DB::table('transaksi')
            ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
            ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
            ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
            ->join('master_acara', 'transaksi.nama_event', '=', 'master_acara.id')      
            ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'master_acara.nama_acara')   
            ->where('id_user', Auth::user()->id)
            ->orderby('id_transaksi','asc')
            ->get();
        return view('transaksi.index', compact('transaksis'));

    }

    public function byPeriode($y,$m)
    {
        $periode = Transaksi::Periode($y,$m);
        $awal = date_format($periode['awal'],'y-m-d');
        $akhir = date_format($periode['akhir'],'y-m-d');
        $result = array();

        $unsurutamas = DB::table('master_unsur_utama')->select('id','unsur_utama')->get();
        foreach($unsurutamas as $uu) {
            $subunsurs = DB::table('master_subunsurs')->select('id_sub_unsur','kegiatan_sub_unsur')->where('id_unsur',$uu->id)->get();
            $temp_su = array();
            foreach($subunsurs as $su) {
                $kegiatans = DB::table('master_rincian_kegiatan')
                ->leftJoin('transaksi','master_rincian_kegiatan.id_rincian_kegiatan','=',DB::raw('transaksi.id_rincian_kegiatan AND transaksi.id_user='.Auth::user()->id.' AND transaksi.tgl_selesai BETWEEN "'.$awal.'" AND "'.$akhir.'"'))
                ->join('master_rincian_angka_kredit','master_rincian_kegiatan.id_rincian_kegiatan','=',DB::raw('master_rincian_angka_kredit.id_rincian_kegiatan AND master_rincian_angka_kredit.id_tingkatan_wi='.Auth::user()->jabatan))
                ->select('master_rincian_angka_kredit.kk','rincian_kegiatan',DB::raw('COUNT(transaksi.id_transaksi) as jumlah_kegiatan'),DB::raw('SUM(transaksi.angka_kredit_usul) as angka_kredit'))
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
        
        return view('transaksi.kegiatan', compact('result','y','m','periode'));
    }
    
    public function byKk($y,$m,$kk)
    {
        if($m==1){
            $awal = date_create($y.'-1-1');
            $akhir = date_create($y.'-6-30');
        } else {
            $awal = date_create($y.'-7-1');
            $akhir = date_create($y.'-12-31');
        }

        $transaksis = DB::table('transaksi')
            ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
            ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
            ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
            ->join('master_acara', 'transaksi.nama_event', '=', 'master_acara.id')
            ->join('master_rincian_angka_kredit','master_rincian_kegiatan.id_rincian_kegiatan','=',DB::raw('master_rincian_angka_kredit.id_rincian_kegiatan AND master_rincian_angka_kredit.id_tingkatan_wi='.Auth::user()->jabatan))    
            ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'master_acara.nama_acara')   
            ->where('id_user', Auth::user()->id)
            ->whereBetween('transaksi.tgl_selesai', [$awal, $akhir])
            ->where('master_rincian_angka_kredit.kk', $kk)
            ->orderby('id_transaksi','asc')
            ->get();
        
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unsurutamas = DB::table("master_unsur_utama")->pluck( 'unsur_utama', 'id');
        $nama_acaras = DB::table("master_acara")->pluck('nama_acara', 'id');
        return view('transaksi.create', compact('unsurutamas', 'nama_acaras'));
    }

    public function createByKk($y,$m,$kk)
    {
        $periode = Transaksi::Periode($y,$m);

        $kegiatan = DB::table("master_rincian_kegiatan")
            ->join('master_unsur_utama', 'master_rincian_kegiatan.id_unsur_utama', '=', 'master_unsur_utama.id')
            ->join('master_subunsurs', 'master_rincian_kegiatan.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')
            ->join('master_rincian_angka_kredit','master_rincian_kegiatan.id_rincian_kegiatan','=',DB::raw('master_rincian_angka_kredit.id_rincian_kegiatan AND master_rincian_angka_kredit.id_tingkatan_wi='.Auth::user()->jabatan))
            ->select('master_unsur_utama.unsur_utama','master_unsur_utama.id','master_subunsurs.kegiatan_sub_unsur','master_subunsurs.id_sub_unsur','master_rincian_kegiatan.id_rincian_kegiatan','master_rincian_kegiatan.rincian_kegiatan')
            ->where('master_rincian_angka_kredit.kk',$kk)
            ->first();
        $nama_acaras = DB::table("master_acara")->pluck('nama_acara', 'id');
        
        return view('transaksi.createbykk', compact('kegiatan', 'nama_acaras', 'periode', 'kk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('memory_limit','50M');
        $file = $request->file('berkas');
        $filename = $file->getClientOriginalName();
        $file->move('file_rincian_dupak', $filename);
        Transaksi::create([
                'id_user' => Auth::user()->id,
                'id_unsur_utama' => $request->unsurutamas,
                'id_subunsur' => $request->subunsur,
                'id_rincian_kegiatan' => $request->rinciankegiatan,
                'id_tingkatan_wi' => 1,
                'nama_event' => $request->nama_acara,
                'keterangan' => $request->keterangan,
                'tgl_mulai' => $request->awal_acara,
                'tgl_selesai' => $request->akhir_acara,
                'angka_kredit_usul' => $request->angka_kredit,
                'id_rinci_ak' => 1,
                'kk' => 1,
                'berkas' => $filename
            ]);
        return redirect('/transaksi/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('transaksi.edit');
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
        ->first();
        //dd($transaksi);
        $unsurutamas = DB::table("master_unsur_utama")->pluck( 'unsur_utama', 'id');
        $nama_acaras = DB::table("master_acara")->pluck('nama_acara', 'id');
        return view('transaksi.edit', compact('transaksi', 'unsurutamas', 'nama_acaras'));
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
        $transaksi = \App\Transaksi::find($id_transaksi);
        if($transaksi) {
            $transaksi->keterangan = $request->keterangan;
            $transaksi->tgl_mulai = $request->awal_acara;
            $transaksi->tgl_selesai = $request->akhir_acara;
            if($request->file('berkas')) {
                $file = $request->file('berkas');
                $filename = $file->getClientOriginalName();
                $file->move('file_rincian_dupak', $filename);
                $transaksi->berkas = $filename; 
                
            } else {
               $transaksi->berkas = $transaksi->berkas;
            }
            $transaksi->save();
        }
        return redirect()->route('transaksi.index')->with('success', 'Hasil Penilaian udpdated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_transaksi)
    {
        Transaksi::destroy($id_transaksi);
        return redirect()->route('transaksi.index')->with('success','Acara deleted successfully');
    }

    public function dupak()
    {
        return view('transaksi.dupak');
    }

    public function generateDupak(Request $request)
    {
        $periode_awal = $request->periode_awal;
        $periode_akhir = $request->periode_akhir;

        $pegawai = DB::table('master_pegawai')
                    ->join('master_pendidikan', 'master_pegawai.pendidikan', '=', 'master_pendidikan.id')
                    ->join('master_pangkat_golongan', 'master_pegawai.pangkat_golongan', '=', 'master_pangkat_golongan.id')            
                    ->join('master_jabatan', 'master_pegawai.jabatan', '=', 'master_jabatan.id')    
                    ->join('master_unit_kerja', 'master_pegawai.unit_kerja', '=', 'master_unit_kerja.id')            
                    ->select('master_pegawai.*','master_pendidikan.nama_pendidikan', 'master_pangkat_golongan.pangkat','master_pangkat_golongan.golongan', 'master_jabatan.nama_jabatan', 'master_unit_kerja.nama_unit_kerja')   
                    ->where('master_pegawai.id', Auth::id())
                    ->get()->first();

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('format_dupak.xlsx'));
        $worksheet = $reader->getActiveSheet();
        $worksheet->setCellValue('B10', 'Masa Penilaian Tanggal: '.tglIndo($periode_awal).' s/d '.tglIndo($periode_akhir).'');
        $worksheet->setCellValue('K13', $pegawai->nama);
        $worksheet->setCellValueExplicit('K14', $pegawai->nip, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $worksheet->setCellValue('K15', $pegawai->no_seri_karpeg);
        $worksheet->setCellValue('K16', $pegawai->tempat_lahir.", ".tglIndo($pegawai->tanggal_lahir));
        if($pegawai->jenis_kelamin == "L"){$worksheet->setCellValue('K17', "Laki-laki");}
        else{$worksheet->setCellValue('K17', "Perempuan");}
        $worksheet->setCellValue('K18', $pegawai->nama_pendidikan);
        $worksheet->setCellValue('K19', $pegawai->pangkat." - ".$pegawai->golongan."/ ".tglIndo($pegawai->tanggal_lahir));
        $worksheet->setCellValue('K20', $pegawai->nama_jabatan."/ ".tglIndo($pegawai->tanggal_lahir));

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($reader);
        $writer->save(storage_path('dupak.xlsx'));

        return response()->download(storage_path('dupak.xlsx'));
    }
}
