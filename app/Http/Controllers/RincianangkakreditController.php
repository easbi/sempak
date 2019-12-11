<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rincianangkakredit;
use App\Metadata;
use DB;


class RincianangkakreditController extends Controller
{
	public function  index()
	{
    	/*->join('master_rincian_kegiatan', 'master_rincian_angka_kredit.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')   
            ->join('master_tingkatan_wi', 'master_rincian_angka_kredit.id_tingkatan_wi', '=', 'master_tingkatan_wi.id_tingkatan_wi') 
            ->select('master_rincian_angka_kredit.*','master_unsur_utama.unsur_utama','master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_tingkatan_wi.nama_tingkatan')       */ 
            $rincianangkakredits = DB::table('master_rincian_angka_kredit')
            ->join('master_unsur_utama', 'master_rincian_angka_kredit.id_unsur_utama', '=', 'master_unsur_utama.id')
            ->join('master_subunsurs', 'master_rincian_angka_kredit.id_subunsur', '=', 'master_subunsurs.id_sub_unsur')            
            ->join('master_rincian_kegiatan', 'master_rincian_angka_kredit.id_rincian_kegiatan', '=', 'master_rincian_kegiatan.id_rincian_kegiatan')    
            ->join('master_tingkatan_wi', 'master_rincian_angka_kredit.id_tingkatan_wi', '=', 'master_tingkatan_wi.id_tingkatan_wi')            
            ->select('master_rincian_angka_kredit.*','master_unsur_utama.unsur_utama', 'master_subunsurs.kegiatan_sub_unsur', 'master_rincian_kegiatan.rincian_kegiatan', 'master_tingkatan_wi.nama_tingkatan')   
            ->orderby('id_rinci_ak','asc')
            ->get();
    		//dd($rincianangkakredits);
            return view('rincianangkakredit.index', compact('rincianangkakredits'));
        }


        public function create()
        {
        	$unsurutamas = DB::table("master_unsur_utama")->pluck( 'unsur_utama', 'id');
        	$tingkatanwi = DB::table("master_tingkatan_wi")->pluck('nama_tingkatan', 'id_tingkatan_wi');
        	return view('rincianangkakredit.create', compact('unsurutamas', 'tingkatanwi'));

        }

        public function getSubunsurList(Request $request)
        {
        	$subunsurs = DB::table("master_subunsurs")->where("id_unsur", $request->unsurutamas_id)->pluck('kegiatan_sub_unsur', 'id_sub_unsur');
        	//dd($subunsurs);
        	return $subunsurs;
        }

        public function getRinciankegiatanList(Request $request)
        {
        	$rinciankegiatans = DB::table("master_rincian_kegiatan")->where("id_subunsur", $request->subunsur_id)->pluck('rincian_kegiatan', 'id_rincian_kegiatan');
        	return $rinciankegiatans;
        }

        public function store(Request $request)
        {
        	Rincianangkakredit::create([
        		'id_unsur_utama' => $request->unsurutamas,
        		'id_subunsur' => $request->subunsur,
        		'id_rincian_kegiatan' => $request->rinciankegiatan,
        		'id_tingkatan_wi' => $request->id_tingkatan_wi,
        		'angka_kredit' => $request->angka_kredit
        	]);
        	return redirect('/rincianangkakredit');
        }
}

