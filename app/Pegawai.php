<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Pegawai extends Model
{
    protected $table = "master_pegawai";
    protected $fillable = [
    	'nama',
    	'nip',
    	'no_seri_karpeg',
    	'tempat_lahir',
    	'tanggal_lahir',
    	'jenis_kelamin',
    	'pendidikan',
    	'pangkat_golongan',
    	'tmt_pangkat_golongan',
    	'jabatan',
    	'tmt_jabatan',
    	'unit_kerja'
    ];
}