<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rincianangkakredit extends Model
{
    protected $table = "master_rincian_angka_kredit";
    protected $fillable = [
    	'id_unsur_utama',
    	'id_subunsur',
    	'id_rincian_kegiatan',
    	'id_tingkatan_wi',
    	'angka_kredit'
    ];
}
