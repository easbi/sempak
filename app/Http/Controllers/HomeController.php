<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use DB;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $y = date("Y");
        $m = date("m");
        $i = 0;
        $result = array();
        if($m<7){
            $arr_periode = array(
                Transaksi::Periode(($y-1),$m),
                Transaksi::Periode(($y-1),($m+6)),
                Transaksi::Periode($y,$m)
            );
        } else {
            $arr_periode = array(
                Transaksi::Periode(($y-1),($m+6)),
                Transaksi::Periode($y,($m-7)),
                Transaksi::Periode($y,($m)),
            );
        }
        // dd($arr_periode);

        foreach($arr_periode as $periode){
            $proses_total = DB::table ('transaksi')->where('id_user', Auth::user()->id)->whereBetween('tgl_selesai', [$periode['awal'], [$periode['akhir']]])->count();
            $proses_11 = DB::table ('transaksi')->select('status1')->where('status1', 1)->where('id_user', Auth::user()->id)->whereBetween('tgl_selesai', [$periode['awal'], [$periode['akhir']]])->count();
            $proses_12 = DB::table ('transaksi')->select('status1')->where('status1', 2)->where('id_user', Auth::user()->id)->whereBetween('tgl_selesai', [$periode['awal'], [$periode['akhir']]])->count();        
            $proses_13 = DB::table ('transaksi')->select('status1')->where('status1', 3)->where('id_user', Auth::user()->id)->whereBetween('tgl_selesai', [$periode['awal'], [$periode['akhir']]])->count();
            
            $result[$i]['awal'] = $periode['awal'];
            $result[$i]['akhir'] = $periode['akhir'];
            $result[$i]['judul'] = $periode['judul'];
            $result[$i]['proses_total'] = $proses_total;
            $result[$i]["proses_11"] = $proses_11;
            $result[$i]["proses_12"] = $proses_12;
            $result[$i]["proses_13"] = $proses_13;
            $i++;
        }
        
        return view('home', compact('result'));
    }

    public function homepage1()
    {
        return view('layouts.homepage.index');
    }
}
