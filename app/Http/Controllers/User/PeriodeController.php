<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Dosen;
use App\Matakuliah;
use App\Mahasiswa;
use App\DaftarKelas;

class PeriodeController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin');
	}

    public function index()
    {
    	$periodeList = Periode::all();
    	return view('user.periode.index', ['periodeList' => $periodeList]);
    }

    public function simpan(Request $request)
    {
    	$this->validate($request,[
    		'nama' => 'required|string',
    	]);
    	Periode::where('status', 'Aktif')->update(['status' => 1]);
    	$periode = new Periode();
    	$periode->nama = $request->nama;
    	$periode->status = 2;
    	$periode->save();
    	return back()->with('status', 'Periode dengan nama '.$periode->nama.' telah disimpan');
    }

    public function get($id)
    {
    	return Periode::find($id);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'nama' => 'required|string',
    	]);
    	$periode = Periode::find($id);
    	$nama = $periode->nama;
    	$periode->nama = $request->nama;
    	if($request->status==2){
    		Periode::where('status', 'Aktif')->update(['status' => 1]);
    	}
    	$periode->status = $request->status;
    	$periode->save();
    	return back()->with('status', 'Periode '.$nama.' telah diperbarui');
    }

	public function matakuliah($id)
	{
		$periode = Periode::find($id);
		$matakuliahs = $periode->matakuliah;
		$dosens = Dosen::all();
    	return view('user.periode.matakuliah.index',['periode' => $periode,'matakuliahs' => $matakuliahs, 'dosens' => $dosens]);
	}

	public function simpanMatakuliah(Request $request, $id)
	{
		$matakuliah = new Matakuliah();
		$matakuliah->nama = $request->nama;
		$matakuliah->kp = $request->kp;
		$matakuliah->dosen_id = $request->pengajar;
		$matakuliah->periode_id = Periode::find($id)->id;
		$matakuliah->save();
		return back()->with('status', 'Matakuliah baru telah disimpan');
	}

	public function getMatakuliah($idPeriode, $idMatakuliah)
	{
		return Periode::find($idPeriode)->matakuliah->find($idMatakuliah);
	}

	public function updateMatakuliah(Request $request, $idPeriode, $idMatakuliah)
	{
		$matakuliah = Periode::find($idPeriode)->matakuliah->find($idMatakuliah);
		$nama = $matakuliah->nama;
		$matakuliah->nama = $request->nama;
		$matakuliah->kp = $request->kp;
		$matakuliah->dosen_id = $request->pengajar;
		$matakuliah->save();
		return back()->with('status', 'Matakuliah '.$nama.' telah diperbarui');
	}

	public function daftarKelas($idPeriode, $idMatakuliah)
	{
		$periode = Periode::find($idPeriode);
		$matakuliah = Matakuliah::find($idMatakuliah);
		$daftarKelas = Periode::find($idPeriode)->matakuliah->find($idMatakuliah)->daftarKelas;
		$mahasiswaTersedia = Mahasiswa::whereNotIn('id', $daftarKelas->pluck('mahasiswa_id'))->get();
		return view('user.periode.matakuliah.daftarKelas.index',['periode' => $periode, 'matakuliah' => $matakuliah,'daftarKelas' => $daftarKelas, 'mahasiswaTersedia' => $mahasiswaTersedia]);
	}

	public function tambahDaftarKelas(Request $request, $idPeriode, $idMatakuliah)
	{
		$daftarKelas = new DaftarKelas();
		$daftarKelas->matakuliah_id = $idMatakuliah;
		$daftarKelas->mahasiswa_id = $request->mahasiswa;
		$daftarKelas->save();
		$mahasiswa = Mahasiswa::find($request->mahasiswa);
		return back()->with('status', 'Mahasiswa NRP '.$mahasiswa->nrp.' telah ditambahkan ke dalam kelas');
	}

	public function getItemDaftarKelas($idPeriode, $idMatakuliah, $idDaftarKelas)
	{
		return Periode::find($idPeriode)->matakuliah->find($idMatakuliah)->daftarKelas->find($idDaftarKelas)->load('mahasiswa');
	}

	public function hapusItemDaftarKelas($idPeriode, $idMatakuliah, $idDaftarKelas)
	{
		if(Periode::find($idPeriode)->matakuliah->find($idMatakuliah)->daftarKelas->find($idDaftarKelas)->logKehadiran->isEmpty()){
			$mahasiswa = Periode::find($idPeriode)->matakuliah->find($idMatakuliah)->daftarKelas->find($idDaftarKelas)->mahasiswa;
			Periode::find($idPeriode)->matakuliah->find($idMatakuliah)->daftarKelas->find($idDaftarKelas)->delete();
			return back()->with('status', 'Mahasiswa '.$mahasiswa->nama.' ('.$mahasiswa->nrp.') telah berhasil dihapus dari daftar kelas.');
		}
		return back()->with('status', 'Gagal menghapus daftar siswa. Karena log kehadiran tidak kosong.');
	}

	public function getLogKehadiran($idPeriode, $idMatakuliah, $idDaftarKelas)
	{
		$periode = Periode::find($idPeriode);
		$matakuliah = Matakuliah::find($idMatakuliah);
		$daftarKelas = Periode::find($idPeriode)->matakuliah->find($idMatakuliah)->daftarKelas->find($idDaftarKelas);
		$logKehadiran = Periode::find($idPeriode)->matakuliah->find($idMatakuliah)->daftarKelas->find($idDaftarKelas)->logKehadiran;
		return view('user.periode.matakuliah.daftarkelas.logkehadiran.index', ['periode' => $periode, 'matakuliah' => $matakuliah,'daftarKelas' => $daftarKelas,'logKehadiran' => $logKehadiran]);
	}
}
