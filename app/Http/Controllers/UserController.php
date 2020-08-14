<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

	public function getAll()
	{
		return view('admin.users-list', ['users' => User::with('image')->get()]);
	}

	 public function store(UserRequest $request)
	 {

			// Subir IMG
			$url = config('helpers.photoDefault');
			if ($request->file('photo')) {
				$path = Storage::disk('public')->put('images', $request->file('photo'));
				$url = $path;
			}

			$user = new User($request->all());
			$image = new Image();
			$image->url = $url;

			$user->save();
			$user->image()->save($image);

			if ($request->ajax()) {
				return response()->json([
					'status' => 200,
					'user' => $user
				]);
			}
			Auth::login($user);
			return redirect('/');
	 }

	public function delete(User $user)
	{
		if(Auth::user() != $user){
			$user->delete();
			return response()->json(['deleted' => 'Ok']);
		}
		return response()->json(['deleted' => 'Forbidden'], 403);
	}
}
