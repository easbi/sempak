<?php

namespace App\Http\Controllers;

use App\Dokdasar;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
use DB;

class DokdasarController extends Controller
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
        $dokdasar = DB::table('master_dok_wi')->where('id_user', Auth::user()->id)->first();
        $cc = Auth::user()->id; 
        //dd($dokdasar);
        return view('dokdasar.index', compact('dokdasar', 'cc'));
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
        #SK PNS
        $file = $request->file('sk_pangkat_pns');
        $sk_pangkat_pns = $file->getClientOriginalName();
        $file->move('public/dok_dasar_dupak/sk_pangkat_pns', $sk_pangkat_pns);

        #SK PNS
        $file = $request->file('sk_jab_wi');
        $sk_jab_wi = $file->getClientOriginalName();
        $file->move('public/dok_dasar_dupak/sk_jab_wi', $sk_jab_wi);

        #SK PNS
        $file = $request->file('pak');
        $pak = $file->getClientOriginalName();
        $file->move('public/dok_dasar_dupak/pak', $pak);

        #SK PNS
        $file = $request->file('karpeg');
        $karpeg = $file->getClientOriginalName();
        $file->move('public/dok_dasar_dupak/karpeg', $karpeg);

        #SK PNS
        $file = $request->file('dp3');
        $dp3 = $file->getClientOriginalName();
        $file->move('public/dok_dasar_dupak/dp3', $dp3);

        $id_user = Auth::user()->id;
        
        Dokdasar::create([
            'id_user' => $id_user,
            'sk_pangkat_pns' => $sk_pangkat_pns,
            'sk_jab_wi' => $sk_jab_wi,
            'pak' => $pak,
            'karpeg' => $karpeg,
            'dp3' => $dp3
        ]);
        return redirect('/dokdasar');
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
        $dokdasar = DB::table('master_dok_wi')->where('id_user',$id)->first();
        return view('dokdasar.edit', compact('dokdasar'));
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
        if($request->file('sk_pangkat_pns')) {
            $file = $request->file('sk_pangkat_pns');
            $filename = $file->getClientOriginalName();
            $file->move('public/dok_dasar_dupak/sk_pangkat_pns', $filename);
            $dokdasar->sk_pangkat_pns = $filename;    
        } else {
            $dokdasar->sk_pangkat_pns = $dokdasar->sk_pangkat_pns;
        }

        if($request->file('sk_jab_wi')) {
            $file = $request->file('sk_jab_wi');
            $filename = $file->getClientOriginalName();
            $file->move('public/dok_dasar_dupak/sk_jab_wi', $filename);
            $dokdasar->sk_jab_wi = $filename;                
        } else {
            $dokdasar->sk_jab_wi = $dokdasar->sk_jab_wi;
        }

        if($request->file('sk_jab_wi')) {
            $file = $request->file('sk_jab_wi');
            $filename = $file->getClientOriginalName();
            $file->move('public/dok_dasar_dupak/sk_jab_wi', $filename);
            $dokdasar->sk_jab_wi = $filename;                
        } else {
            $dokdasar->sk_jab_wi = $dokdasar->sk_jab_wi;
        }


        if($request->file('pak')) {
            $file = $request->file('pak');
            $filename = $file->getClientOriginalName();
            $file->move('public/dok_dasar_dupak/pak', $filename);
            $dokdasar->pak = $filename;                
        } else {
            $dokdasar->pak = $dokdasar->pak;
        }

        if($request->file('dp3')) {
            $file = $request->file('dp3');
            $filename = $file->getClientOriginalName();
            $file->move('public/dok_dasar_dupak/dp3', $filename);
            $dokdasar->dp3 = $filename;
        } else {
            $dokdasar->dp3 = $dokdasar->dp3;
        }

        $dokdasar->save();
        
        return redirect()->route('dokdasar.index');
    
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
