<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function getAllByCategory(Category $Category)
	{
		$products = $Category->with('products.image')->get();
// plurar
		return view('product', compact('products'));
	}

}
