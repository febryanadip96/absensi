<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dosen;

class DosenController extends Controller
{
    public function __construct()
    {
    	$this->middleware('admin');
    }

    public function index()
    {
    	$dosenList = Dosen::all();
    	return view('user.dosen.index', ['dosenList' => $dosenList]);
    }

    public function simpan(Request $request)
    {
    	$user = new User();
    	$user->role = 2;
    	$user->name = $request->nama;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->save();
    	$dosen = new Dosen();
    	$dosen->nik = $request->nik;
    	$dosen->user_id = $user->id;
    	$dosen->save();
    	return back()->with('status', 'Dosen baru telah disimpan');
    }

    public function get($id)
    {
    	return Dosen::find($id)->load('user');
    }

    public function update(Request $request, $id)
    {
    	$dosen = Dosen::find($id);
    	if(isset($request->password)){
    		$dosen->user->password = bcrypt($request->password);
    		$dosen->save();
    	}
    	$dosen->nik = $request->nik;
    	$dosen->save();
    	return back()->with('status', 'Dosen dengan nama '.$dosen->user->name.' telah diperbarui');
    }
}
