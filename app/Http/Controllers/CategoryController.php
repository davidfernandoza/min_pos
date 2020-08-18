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

		// Update
		if ( $category->id) {
			 $category->update($request->all());
		}
		// Create
		else{
			 $category = new Category($request->all());
			 $category->save();
		}

		return response()->json([
			'status' => 200,
			'categories' => $category::get()
		]);

	}

	public function delete(Category $category)
	{
		$category->delete();
		return response()->json(['deleted' => 'OK']);
	}
}
