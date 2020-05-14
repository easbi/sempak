<?php

namespace App\Http\Controllers;

use App\Dokdasar;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
use DB;

class DokutkusulController extends Controller
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
        $dokutkusul = DB::table('master_dok_wi')->where('id_user', Auth::user()->id)->first();
        $cc = Auth::user()->id; 
        //dd($cc);
        return view('dokusul.index', compact('dokutkusul', 'cc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokdasar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dokdasar  $dokdasar
     * @return \Illuminate\Http\Response
     */
    public function show(Dokdasar $dokdasar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dokdasar  $dokdasar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokutkusul = DB::table('master_dok_wi')->where('id_user',$id)->first();
        return view('dokusul.edit', compact('dokutkusul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dokdasar  $dokdasar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_user)
    {
        $dokdasar = \App\Dokdasar::find($id_user);
        if($request->file('pengantar')) {
            $file = $request->file('pengantar');
            $filename = Auth::user()->nip .'_'.$file->getClientOriginalName();
            $file->move('public/dok_dasar_dupak/pengantar', $filename);
            $dokdasar->pengantar = $filename;    
        } else {
            $dokdasar->pengantar = $dokdasar->pengantar;
        }

        if($request->file('dupak')) {
            $file = $request->file('dupak');
            $filename = Auth::user()->nip .'_'.$file->getClientOriginalName();
            $file->move('public/dok_dasar_dupak/dupak', $filename);
            $dokdasar->dupak = $filename;                
        } else {
            $dokdasar->dupak = $dokdasar->dupak;
        }
        $dokdasar->save();
        
        return redirect()->route('dokutkusul.index');
    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dokdasar  $dokdasar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokdasar $dokdasar)
    {
        //
    }
}
