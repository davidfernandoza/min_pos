<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function getAll()
	 {
		 return response()->json(Category::has('products')->with(['products' => function ($query)
		 {
			 return $query->take(10)->with('image');
		 }])->get());
	 }
}
