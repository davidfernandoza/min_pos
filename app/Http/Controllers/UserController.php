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

	public function store(UserRequest $request, User $user)
	{
		//Img
		if($request->file('photo')){
			$path = Storage::disk('public')->put('images', $request->file('photo'));
		}
		else $path = config('helpers.photoDefault');
		$image = new Image();
		$image->url = "/".$path;

		// Update
		if ($user->id) {
			$user->update($request->all());
			if($request->file('photo')){
				$user->image()->update($image->toArray());
			}
		}

		// Create
		else{
			$user = new User($request->all());
			$user->password = $request->password;
			$user->save();
			$user->image()->save($image);
		}

		// Response
		if ($request->ajax()) {
			return response()->json([
				'status' => 200,
				'users' => $user::with('image')->get()
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
