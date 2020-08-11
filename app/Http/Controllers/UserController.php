<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

	 public function store(UserRequest $request)
	 {
			$user = new User($request->all());
			$user->save();

			if ($request->format() == "html") {
				Auth::login($user);
				return redirect('/');
			}
			return response()->json([
				'status' => 200,
				'user' => $user
			]);
	 }
}
