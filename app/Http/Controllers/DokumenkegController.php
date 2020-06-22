<?php

namespace App\Http\Controllers;

use App\Dokumenkeg;
use App\Masteracara;
use Illuminate\Http\Request;
use Auth;
use DB;
use File; 

class DokumenkegController extends Controller
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
        $dokumenkeg = DB::table('transaksi_dok_spmk_stmk')->where('id_user', Auth::user()->id)->get();
        $cc = Auth::user()->id; 
        //dd($dokumenkeg);
        return view('transaksi.dokspmtstmt.index', compact('dokumenkeg', 'cc'));
    }

    public function autocomplete(Request $request)
    {
        if($request->get('term'))
        {
          $search = $request->get('term');
          $result  = Masteracara::where('nama_acara', 'LIKE', '%'. $search. '%')->get();
          //dd($query);
          return response()->json($result);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.dokspmtstmt.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $acara = $request->acara;

        if ($request->has('checkbox_spmt')){
            $spmt_berkas = NULL;
            $spmt_url = $request->spmt_url;
        } else {
            if ($request->hasFile('spmt_berkas'))
            {
               $file = $request->file('spmt_berkas');
               $spmt_berkas = 'SPMT-'.\Carbon\Carbon::now()->format('Y-m-d H-i').'_'. Auth::user()->nip .'_'. str_replace(' ', '', substr(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 25)). '.' .$file->getClientOriginalExtension();
               $file->move('public/dok_spmt_stmt_dupak', $spmt_berkas);
            }
            $spmt_url = NULL;
        }


        //check the existing of checkbox stmt_url
        if ($request->has('checkbox_stmt')){
            $stmt_berkas = NULL;
            $stmt_url = $request->stmt_url;
        } else {
            $file = $request->file('stmt_berkas');
            $stmt_berkas = 'STMT-'.\Carbon\Carbon::now()->format('Y-m-d H-i').'_'. Auth::user()->nip .'_'. str_replace(' ', '', substr(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 25)). '.' .$file->getClientOriginalExtension();
            $file->move('public/dok_spmt_stmt_dupak', $stmt_berkas);
            $stmt_url = NULL;
        }

        Dokumenkeg::create([
            'id_user' => Auth::user()->id,
            'acara' => $acara,
            'spmt_berkas' => $spmt_berkas,
            'spmt_url' => $spmt_url,
            'stmt_berkas' => $stmt_berkas,
            'stmt_url' => $stmt_url
        ]);
        return redirect('/dokumenkeg');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dokumenkeg  $dokumenkeg
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumenkeg $dokumenkeg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dokumenkeg  $dokumenkeg
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumenkeg $dokumenkeg)
    {
        return view('transaksi.dokspmtstmt.edit', compact('dokumenkeg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dokumenkeg  $dokumenkeg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dokumenkeg = \App\Dokumenkeg::find($id);
        if($dokumenkeg){
            $dokumenkeg->acara = $request->acara;
            if ($request->has('checkbox_spmt')){
                $dokumenkeg->spmt_berkas = NULL;
                $dokumenkeg->spmt_url = $request->spmt_url;
            } else {
                if ($request->hasFile('spmt_berkas'))
                {
                    $file = $request->file('spmt_berkas');
                    $dokumenkeg->spmt_berkas = 'SPMT-'.\Carbon\Carbon::now()->format('Y-m-d H-i').'_'. Auth::user()->nip .'_'. str_replace(' ', '', substr(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 25)). '.' .$file->getClientOriginalExtension();
                    $file->move('public/dok_spmt_stmt_dupak', $dokumenkeg->spmt_berkas);
                    $dokumenkeg->spmt_url = NULL;
                } else {
                    $dokumenkeg->spmt_berkas = $dokumenkeg->spmt_berkas;
                }
            }

            if ($request->has('checkbox_stmt')){
                $dokumenkeg->stmt_berkas = NULL;
                $dokumenkeg->stmt_url = $request->stmt_url;
            } else {
                if ($request->hasFile('stmt_berkas')){
                    $file = $request->file('stmt_berkas');
                    $dokumenkeg->stmt_berkas = 'STMT-'.\Carbon\Carbon::now()->format('Y-m-d H-i').'_'. Auth::user()->nip .'_'. str_replace(' ', '', substr(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), 0, 25)). '.' .$file->getClientOriginalExtension();
                    $file->move('public/dok_spmt_stmt_dupak', $dokumenkeg->stmt_berkas);
                    $dokumenkeg->stmt_url = NULL;                    
                } else {
                    $dokumenkeg->stmt_berkas = $dokumenkeg->stmt_berkas;
                }
            }
         $dokumenkeg->save();
        }
     return redirect('/dokumenkeg');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dokumenkeg  $dokumenkeg
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filepath = Dokumenkeg::where('id',$id)->first();
        //dd($filepath);
        File::delete('public/dok_spmt_stmt_dupak/'.$filepath->stmt_berkas);
        File::delete('public/dok_spmt_stmt_dupak/'.$filepath->spmt_berkas);
        Dokumenkeg::destroy($id);
        return redirect()->route('dokumenkeg.index')->with('success','STMT SPMT deleted successfully');
    }
}
