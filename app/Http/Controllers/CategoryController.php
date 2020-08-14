<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
				return $query->take(10)->with('image');
			}])->has('products')->get();

			return response()->json($categories);
		}

		return view('admin.categories-list', ['categories' => Category::get()]);
	}
}
