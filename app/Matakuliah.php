<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajar()
    {
        return $this->belongsTo('App\Dosen', 'dosen_id');
    }

    public function periode()
    {
        return $this->belongsTo('App\Periode', 'periode_id');
    }

	public function daftarKelas()
	{
		return $this->hasMany('App\DaftarKelas', 'matakuliah_id');
	}
}
