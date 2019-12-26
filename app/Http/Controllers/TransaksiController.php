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

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        ->get();
        //dd($transaksi);
        return view('transaksi.edit', compact('transaksi'));
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
        $transaksi = DB::table('transaksi')->where('id_transaksi',$id_transaksi)
        ->join('master_unsur_utama', 'transaksi.id_unsur_utama', '=', 'master_unsur_utama.id')
        ->join('master_subunsurs', 'transaksi.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
        ->join('master_rincian_kegiatan', 'transaksi.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
        ->join('master_acara', 'transaksi.nama_event', '=', 'master_acara.id')      
        ->select('transaksi.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_rincian_kegiatan.satuan', 'master_acara.nama_acara') 
        ->get();
        //dd($transaksi);
        return view('transaksi.edit', compact('transaksi'));
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
