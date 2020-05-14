<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Masteracara;
use DB;

class MasteracaraController extends Controller
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
        $acaras = DB::table('master_acara')->orderBy('id', 'desc')->get();
        //dd($acaras);
        return view('masteracara.index', compact('acaras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masteracara.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Masteracara::create([
                'nama_acara' => $request->nama_acara,
                'awal_acara' => $request->awal_acara,
                'akhir_acara' => $request->akhir_acara
            ]);
        return redirect('/masteracara');
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
    public function edit(Masteracara $masteracara)
    {
        return view('masteracara.edit', compact('masteracara'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masteracara $masteracara)
    {
        $masteracara->update($request->all());
        return redirect()->route('masteracara.index')->with('success', 'Masteracara udpdated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masteracara $masteracara)
    {
        $masteracara->delete();  
        return redirect()->route('masteracara.index')->with('success','Acara deleted successfully');
    }
}
