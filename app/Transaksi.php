<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
    	'id_user',
    	'id_rinci_ak',
        'ak',
    	'nama_event',
    	'tgl_mulai',
    	'tgl_selesai',
    	'keterangan',
    	'berkas',
    	'angka_kredit_usul',
    	'id_penilai1',
    	'id_penilai2',
    	'angka_kredit1',
    	'angka_kredit2',
    	'status1',
    	'status2',
    	'ket_status1',
    	'ket_status2',
    ];

}
