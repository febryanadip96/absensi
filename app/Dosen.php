<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function mengajar()
    {
        return $this->hasMany('App\Matakuliah', 'dosen_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
