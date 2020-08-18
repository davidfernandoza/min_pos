<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
	public function get(Category $Category)
	{
		$category =	$Category->with('products.image')->find($Category);
		return view('category', ['category' => $category[0]]);
	}

	public function getAll(Request $request)
	{

		if($request->ajax()){
			$categories = Category::with(['products' => function ($query){
				return $query->take(40)->with('image');
			}])->has('products')->get();

			return response()->json($categories);
		}

		return view('admin.categories-list', ['categories' => Category::get()]);
	}

	public function store(CategoryRequest $request, Category $category)
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

	public function delete(Category $category)
	{
		$category->delete();
		return response()->json(['deleted' => 'OK']);
	}
}
