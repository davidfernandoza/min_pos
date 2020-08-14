<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

	public function get($id = NULL)
	{
		$product =	Product::has('category')->with('image', 'category')->find($id);
		if (!$product) {
			$product = new Product();
		}
		return view('product-info', compact('product'));
	}

	public function getAll(Request $request)
	{
		$products =	Product::has('category')->with('image', 'category')->get();
		return view('admin.products-list', compact('products'));
	}

	public function search(Request $request)
	{
		$request->validate([
			'search' => ['required'],
		]);

		$products =	Product::has('category')->with('category', 'image')
		->name($request->search)
		->description($request->search)
		->get();

		return view('product-search', compact('products'));
	}

	public function delete(Product $product)
	{
		$product->delete();
		return response()->json(['deleted' => 'OK']);
	}
}
