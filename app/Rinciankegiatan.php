<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rinciankegiatan extends Model
{
    protected $table = "master_rincian_kegiatan";
    protected $fillable = [
    	'id_unsur_utama',
    	'id_subunsur',
    	'rincian_kegiatan',
    	'satuan'
    ];
}
