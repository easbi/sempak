<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $primaryKey = 'id_transaksi';
    protected $fillable = [
    	'id_user',
        'id_unsur_utama',
        'id_subunsur',
        'id_rincian_kegiatan',
    	'nama_event',
    	'tgl_mulai',
    	'tgl_selesai',
    	'keterangan',
    	'berkas',
        'id_rinci_ak',
        'kk',
        'kuantitas',
        'ak_per_satuan',
    	'angka_kredit_usul',
    	'id_penilai1',
    	'id_penilai2',
    	'angka_kredit1',
    	'angka_kredit2',
    	'status1',
    	'status2',
    	'ket_status1',
    	'ket_status2',
        'flag_submited',
	];

	public function scopeGetPeriode($query,$y,$m)
	{
		if($m<7){
			
		} else {

		}
	}
	
	public function scopePeriode($query,$y,$m)
    {	
        if($m<7){
            $result = array(
                "awal" => date_create($y."-01-01"),
                "akhir" => date_create($y."-06-30"),
                "judul" => "Semester I ".$y
            );
        } else {
            $result = array(
                "awal" => date_create($y."-07-01"),
                "akhir" => date_create($y."-12-31"),
                "judul" => "Semester II ".$y
            );
		}
		
		return $result;
    }

}
