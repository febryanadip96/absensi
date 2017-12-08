<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarKelas extends Model
{
    protected $table = 'daftar_kelas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function matakuliah()
    {
    	return $this->belongsTo('App\Matakuliah', 'matakuliah_id');
    }

    public function mahasiswa()
    {
    	return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id');
    }

    public function logKehadiran()
    {
    	return $this->hasMany('App\LogKehadiran', 'daftar_kelas_id');
    }
}
