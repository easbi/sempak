<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rinciankegiatan;
use App\Metadata;
use DB;

class RinciankegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rinciankegiatan = Rinciankegiatan::all();
        return view('rinciankegiatan.index', ['rinciankegiatan' => $rinciankegiatan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unsurutamas = DB::table("master_unsur_utama")->pluck( 'unsur_utama', 'id');
        return view('rinciankegiatan.create', compact('unsurutamas'));
    }

    public function getSubunsurList($id)
    {
        $subunsurs = DB::table("master_subunsurs")->where("id_unsur", $id)->pluck('kegiatan_sub_unsur', 'id_sub_unsur');
        //dd($subunsurs);
        return json_encode($subunsurs);
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
