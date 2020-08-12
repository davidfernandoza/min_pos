<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

	public function get($id = NULL)
	{
		$product =	Product::with('image', 'category')->find($id);
		if (!$product) {
			$product = new Product();
		}
		return view('product-info', compact('product'));
	}

	public function getAllByCategory(Category $Category)
	{
		$products =	$Category->with('products.image')->find($Category);
		return view('product', ['category' => $products[0]]);
	}

}
