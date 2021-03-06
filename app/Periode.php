<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function matakuliah()
    {
        return $this->hasMany('App\Matakuliah', 'periode_id');
    }
}
