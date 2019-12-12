<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masteracara extends Model
{
    protected $table = "master_acara";
    protected $fillable = [
    	'nama_acara',
    	'awal_acara',
    	'akhir_acara'
    ];
}
