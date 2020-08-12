<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function getAllByCategory(Category $Category)
	{
	 $products =	$Category->with('products.image')->find($Category);
		return view('product', ['category' => $products[0]]);
	}

}
