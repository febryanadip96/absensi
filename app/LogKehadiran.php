<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogKehadiran extends Model
{
    protected $table = 'log_kehadiran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function daftarKelas()
    {
    	return $this->belongsTo('App\DaftarKelas', 'daftar_kelas_id');
    }
}
