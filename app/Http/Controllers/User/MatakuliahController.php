<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Matakuliah;
use App\Dosen;

class MatakuliahController extends Controller
{
    public function __construct()
    {
    	$this->middleware('admin');
    }

    public function index()
    {
    	$matakuliahs = Periode::where('status', 'Aktif')->first()->matakuliah;
		$dosens = Dosen::all();
    	return view('user.matakuliah.index',['matakuliahs' => $matakuliahs, 'dosens' => $dosens]);
    }

	public function simpan(Request $request)
	{
		$matakuliah = new Matakuliah();
		$matakuliah->nama = $request->nama;
		$matakuliah->kp = $request->kp;
		$matakuliah->dosen_id = $request->pengajar;
		$matakuliah->periode_id = Periode::where('status', 'Aktif')->first()->id;
		$matakuliah->save();
		return back()->with('status', 'Matakuliah baru telah disimpan');
	}

	public function get($id)
	{
		return Matakuliah::find($id);
	}

	public function update(Request $request, $id)
	{
		$matakuliah = Matakuliah::find($id);
		$nama = $matakuliah->nama;
		$matakuliah->nama = $request->nama;
		$matakuliah->kp = $request->kp;
		$matakuliah->dosen_id = $request->pengajar;
		$matakuliah->save();
		return back()->with('status', 'Matakuliah '.$nama.' telah diperbarui');
	}
}
