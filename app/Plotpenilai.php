<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plotpenilai extends Model
{
    protected $table = "plot_penilai_dupak";
    protected $fillable = [
    	'id_user_dinilai',
    	'id_user_penilai_1',
    	'id_user_penilai_2'
    ];
}
