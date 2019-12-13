<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    protected $table = 'master_unsur_utama';
    protected $fillable = ['unsur_utama'];
}
