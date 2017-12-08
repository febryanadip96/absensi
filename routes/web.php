<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('periode', 'User\PeriodeController@index');
Route::get('periode/{id}', 'User\PeriodeController@get');
Route::post('periode', 'User\PeriodeController@simpan');
Route::put('periode/{id}', 'User\PeriodeController@update');

Route::get('periode/{id}/matakuliah', 'User\PeriodeController@matakuliah');
Route::get('periode/{idPeriode}/matakuliah/{idMatakuliah}', 'User\PeriodeController@getMatakuliah');
Route::post('periode/{id}/matakuliah', 'User\PeriodeController@simpanMatakuliah');
Route::put('periode/{idPeriode}/matakuliah/{idMatakuliah}', 'User\PeriodeController@updateMatakuliah');

Route::get('periode/{idPeriode}/matakuliah/{idMatakuliah}/daftarkelas', 'User\PeriodeController@daftarKelas');
Route::get('periode/{idPeriode}/matakuliah/{idMatakuliah}/daftarkelas/{idDaftarKelas}', 'User\PeriodeController@getItemDaftarKelas');
Route::post('periode/{idPeriode}/matakuliah/{idMatakuliah}/daftarkelas', 'User\PeriodeController@tambahDaftarKelas');
Route::delete('periode/{idPeriode}/matakuliah/{idMatakuliah}/daftarkelas/{idDaftarKelas}', 'User\PeriodeController@hapusItemDaftarKelas');

Route::get('periode/{idPeriode}/matakuliah/{idMatakuliah}/daftarkelas/{idDaftarKelas}/logkehadiran', 'User\PeriodeController@getLogKehadiran');

Route::get('dosen', 'User\DosenController@index');
Route::get('dosen/{id}', 'User\DosenController@get');
Route::post('dosen', 'User\DosenController@simpan');
Route::put('dosen/{id}', 'User\DosenController@update');

Route::get('mahasiswa', 'User\MahasiswaController@index');
Route::get('mahasiswa/{id}', 'User\MahasiswaController@get');
Route::post('mahasiswa', 'User\MahasiswaController@simpan');
Route::put('mahasiswa/{id}', 'User\MahasiswaController@update');
Route::get('mahasiswa/{id}/matakuliah', 'User\MahasiswaController@matakuliah');
