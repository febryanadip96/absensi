<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class LoginController extends Controller
{
	private $client;

	public function __construct()
	{
		$this->client=\Laravel\Passport\Client::find(2);
	}

	public function login(Request $request)
	{
		$user = User::where('username', $request->username)->first();
		if(!$user){
			return response()->json([
				'message'=>'Akun tidak ditemukan',
			]);
		}

		if($user->role!=2){
			return response()->json([
				'message'=>'Akun Anda tidak bisa digunakan',
			]);
		}

		//request access_token & refresh_token
		$params=[
			'grant_type' => 'password',
		  	'client_id' => $this->client->id,
		  	'client_secret' => $this->client->secret,
		  	'username' => $request->username,
		  	'password' => $request->password,
		  	'scope' => '',
		];

		$request->request->add($params);

		$proxy = Request::create('oauth/token','POST');

		return \Route::dispatch($proxy);
	}
}
