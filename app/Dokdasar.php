<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokdasar extends Model
{
    protected $table = "master_dok_wi";
    public $primaryKey = 'id_user';
    protected $fillable = [
    	'id_user',
    	'sk_pangkat_pns',
    	'sk_jab_wi',
    	'pak',
    	'karpeg',
    	'dp3',
        'ringkasan',
        'pengantar'
    ];
}
