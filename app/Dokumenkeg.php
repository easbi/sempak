<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumenkeg extends Model
{
    protected $table = "transaksi_dok_spmk_stmk";
    protected $fillable = [
    	'id_user',
    	'acara',
    	'spmt_berkas',
    	'spmt_url',
    	'stmt_berkas',
    	'stmt_url'
    ];

}
