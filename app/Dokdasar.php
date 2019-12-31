<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokdasar extends Model
{
    protected $table = "master_dok_wi";
    protected $fillable = [
    	'id_user',
    	'sk_pangkat_pns',
    	'sk_jab_wi',
    	'pak',
    	'karpeg',
    	'dp3'
    ];
}
