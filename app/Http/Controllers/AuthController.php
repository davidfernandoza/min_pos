<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

   public function login(Request $request)
	 {
			$credentials = $request->only('email', 'password');

			if (Auth::attempt($credentials)) {
				if(Auth::user()->rol == 'ADMIN'){
					return redirect()->route('dashboard');
				}
				return redirect('/');
			}
			return redirect()
			->intended('/auth/login')
			->withErrors(['credentials' => [trans('auth.failed')]])->withInput();
	 }

	 public function logout()
	 {
			Auth::logout();
			return redirect('/');
	 }


}
