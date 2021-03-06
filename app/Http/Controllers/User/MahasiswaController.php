<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Mahasiswa;
use App\Matakuliah;

class MahasiswaController extends Controller
{
	public function __construct()
    {
    	$this->middleware('admin');
    }

    public function index()
	{
		$mahasiswas = Mahasiswa::all();
		return view('user.mahasiswa.index', ['mahasiswas' => $mahasiswas]);
	}

	public function get($id)
	{
		return Mahasiswa::find($id);
	}

	public function simpan(Request $request)
	{
		$mahasiswa = new Mahasiswa();
		$mahasiswa->nama = $request->nama;
		$mahasiswa->nrp = $request->nrp;
		$mahasiswa->save();
		return back()->with('status', 'Mahasiswa baru telah disimpan');
	}

	public function matakuliah($id)
	{
		$mahasiswa = Mahasiswa::find($id);
		$daftarKelas = $mahasiswa->daftarKelas;
		$periodeIdList = Matakuliah::whereIn('id', $daftarKelas->pluck('matakuliah_id'))->pluck('periode_id');
		$periode = Periode::whereIn('id', $periodeIdList)->get();
		return view('user.mahasiswa.logkehadiran', ['periode' => $periode,'mahasiswa' => $mahasiswa,'daftarKelas' => $daftarKelas]);
	}
}
