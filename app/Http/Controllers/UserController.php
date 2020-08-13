<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

	 public function store(UserRequest $request)
	 {

			// Subir IMG
			// $url = 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
			// if ($request->file('photo')) {
			// 	$path = Storage::disk('public')->put('images', $request->file('photo'));
			// 	$url = $path;
			// }

			$user = new User($request->all());
			$user->save();
			// $user->image()->save($url);

			if ($request->ajax()) {
				return response()->json([
					'status' => 200,
					'user' => $user
				]);
			}
			Auth::login($user);
			return redirect('/');
	 }
}
