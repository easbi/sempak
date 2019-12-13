<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Transaksi::create([
                'id_user' => 1,
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
                'berkas' => 'sasasa.sas'
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
