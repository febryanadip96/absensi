<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LogKehadiran;
use App\Mahasiswa;
use App\Matakuliah;
use App\DaftarKelas;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function simpanKehadiran(Request $request)
	{
		if($request->user()->dosen->mengajar->find($request->matakuliah))
		{
			$daftarKelas = DaftarKelas::where('matakuliah_id', $request->matakuliah)->where('mahasiswa_id', $request->mahasiswa)->first();
			if($daftarKelas)
			{
				if($daftarKelas->logKehadiran->where('tanggal', Carbon::today()->toDateString())->first()){
					//log hari ini belum ada
					$logKehadiran = $daftarKelas->logKehadiran->where('tanggal', Carbon::today()->toDateString())->first();
					$logKehadiran->kepulangan = Carbon::now();
					$logKehadiran->save();
					return response()->Json([
						'message' => 'Log Kehadiran kepulangan tersimpan.',
					]);
				}
				else{
					//log hari ini belum ada
					$logKehadiran = new LogKehadiran();
					$logKehadiran->tanggal = Carbon::today()->toDateString();
					$logKehadiran->kedatangan = Carbon::now();
					$logKehadiran->daftar_kelas_id = $daftarKelas->id;
					$logKehadiran->save();
					return response()->Json([
						'message' => 'Log Kehadiran kedatangan tersimpan.',
					]);
				}

			}
			return response()->Json([
				'message' => 'Mahasiswa tidak terdaftar di dalam kelas.',
			]);
		}
		return response()->Json([
			'message' => 'Anda tidak mengajar di kelas yang diinputkan',
		]);
	}
}
