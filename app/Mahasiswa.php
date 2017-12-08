<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function daftarKelas()
    {
        return $this->hasMany('App\DaftarKelas', 'mahasiswa_id');
    }
}
