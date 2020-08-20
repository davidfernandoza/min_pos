<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
	public function get(Request $request, Category $Category)
	{
		if($request->ajax()){
			return $Category::find($Category)->first();
		}
		$category =	$Category->with('products.image')->find($Category)->first();
		return view('category', compact('category'));
	}

	public function getAll(Request $request)
	{
		if($request->is('admin/categories/data-table')){
			return DataTables::of(Category::all())->addColumn('actions', function ($category){
				return "
				<button data-id='{$category->id}' data-toggle='modal' class='btn btn-sm btn-warning fas fa-edit' role='edit'></button>
				<button data-id='{$category->id}' class='btn btn-sm btn-danger fas fa-trash-alt' role='delete'></button>";
			})->make(true);

		}
		elseif ($request->is('admin/*')) {
			$categories = Category::get();
		}
		else {
			$categories = Category::has('products')->with(['products' => function ($query){
				return $query->take(40)->with('image');
			}])->get();
		}
		return response()->json($categories);
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
