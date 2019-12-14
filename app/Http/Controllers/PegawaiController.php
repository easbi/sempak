<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use DB;


class PegawaiController extends Controller
{
	public function index()
	{
            $pegawais = DB::table('master_pegawai')
            ->join('master_pendidikan', 'master_pegawai.pendidikan', '=', 'master_pendidikan.id')
            ->join('master_pangkat_golongan', 'master_pegawai.pangkat_golongan', '=', 'master_pangkat_golongan.id')            
            ->join('master_jabatan', 'master_pegawai.jabatan', '=', 'master_jabatan.id')    
            ->join('master_unit_kerja', 'master_pegawai.unit_kerja', '=', 'master_unit_kerja.id')            
            ->select('master_pegawai.*','master_pendidikan.nama_pendidikan', 'master_pangkat_golongan.pangkat','master_pangkat_golongan.golongan', 'master_jabatan.nama_jabatan', 'master_unit_kerja.nama_unit_kerja')   
            ->orderby('master_pegawai.nip','asc')
            ->get();
            return view('pegawai.index', ['pegawais' => $pegawais]);
        }

        public function tambah() { 
            $pendidikans = DB::table('master_pendidikan')->get();
            $pangkat_golongans = DB::table('master_pangkat_golongan')->get();
            $jabatans = DB::table('master_jabatan')->get();

            // dd($pendidikans);
             return view('pegawai.tambah', ['pendidikans' => $pendidikans, 'pangkat_golongans' => $pangkat_golongans, 'jabatans' => $jabatans]); 
        }

        public function store(Request $request)
        {
            $this->validate($request,[
                'nip' => 'required',
                'nama' => 'required',
                'no_seri_karpeg' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'pendidikan' => 'required',
                'pangkat_golongan' => 'required',
                'tmt_pangkat_golongan' => 'required',
                'jabatan' => 'required',
                'tmt_jabatan' => 'required',
                'unit_kerja' => 'required'
             ]);

        	Pegawai::create([
        		'nip' => $request->nip,
        		'nama' => $request->nama,
        		'no_seri_karpeg' => $request->no_seri_karpeg,
        		'tempat_lahir' => $request->tempat_lahir,
        		'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan' => $request->pendidikan,
                'pangkat_golongan' => $request->pangkat_golongan,
                'tmt_pangkat_golongan' => $request->tmt_pangkat_golongan,
                'jabatan' => $request->jabatan,
                'tmt_jabatan' => $request->tmt_jabatan,
                'unit_kerja' => $request->unit_kerja
        	]);
        	return redirect('/pegawai');
        }

        public function edit($id)
        {
            $pegawai = Pegawai::find($id);
            $pendidikans = DB::table('master_pendidikan')->get();
            $pangkat_golongans = DB::table('master_pangkat_golongan')->get();
            $jabatans = DB::table('master_jabatan')->get();
            return view('pegawai.edit', ['pegawai' => $pegawai, 'pendidikans' => $pendidikans, 'pangkat_golongans' => $pangkat_golongans, 'jabatans' => $jabatans]);
        }

        public function update($id, Request $request)
        {
            $this->validate($request,[
               'nip' => 'required',
               'nama' => 'required',
               'no_seri_karpeg' => 'required',
               'tempat_lahir' => 'required',
               'tanggal_lahir' => 'required',
               'jenis_kelamin' => 'required',
               'pendidikan' => 'required',
               'pangkat_golongan' => 'required',
               'tmt_pangkat_golongan' => 'required',
               'jabatan' => 'required',
               'tmt_jabatan' => 'required',
               'unit_kerja' => 'required'
            ]);
         
            $pegawai = Pegawai::find($id);
            $pegawai->nama = $request->nama;
            $pegawai->nip = $request->nip;
            $pegawai->no_seri_karpeg = $request->no_seri_karpeg;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->pendidikan = $request->pendidikan;
            $pegawai->pangkat_golongan = $request->pangkat_golongan;
            $pegawai->tmt_pangkat_golongan = $request->tmt_pangkat_golongan;
            $pegawai->jabatan = $request->jabatan;
            $pegawai->tmt_jabatan = $request->tmt_jabatan;
            $pegawai->unit_kerja = $request->unit_kerja;
            $pegawai->save();

            return redirect('/pegawai');
        }

        public function delete($id)
        {
            $pegawai = Pegawai::find($id);
            $pegawai->delete();
            return redirect('/pegawai');
        }
}

