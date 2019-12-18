<?php

namespace App\Http\Controllers;

use App\Plotpenilai;
use Illuminate\Http\Request;
use DB;

class PlotpenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plotpenilais = DB::table('plot_penilai_dupak')->get(); 
        return view('plotpenilai.index', compact('plotpenilais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $namas = DB::table("master_pegawai")->pluck( 'nama', 'id');
        return view('plotpenilai.create', compact('namas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Plotpenilai::create([
                'id_user_dinilai' => $request->user_dinilai,
                'id_user_penilai_1' => $request->user_penilai_1,
                'id_user_penilai_2' => $request->user_penilai_2
            ]);
        return redirect('/plotpenilai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function show(Plotpenilai $plotpenilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Plotpenilai $plotpenilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plotpenilai $plotpenilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plotpenilai  $plotpenilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plotpenilai $plotpenilai)
    {
        //
    }
}
