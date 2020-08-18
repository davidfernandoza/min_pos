<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

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
		$products =	Product::has('category')
			->with('image', 'category')
			->orderBy('created_at', 'desc')
			->get();
		return view('admin.products-list', compact('products'));
	}

	public function store(ProductRequest $request, Product $product)
	{
		//Img
		if($request->file('photo')){
			$path = Storage::disk('public')->put('images/products', $request->file('photo'));
		}else $path = config('helpers.photoProductDefault');
		$image = new Image();
		$image->url = "/".$path;

		// Update
		if ($product->id) {
			$product->update($request->all());
			if($request->file('photo')){
				$product->image()->update($image->toArray());
			}
		}

		// Create
		else{
			$product = new Product($request->all());
			$product->save();
			$product->image()->save($image);
		}

		return response()->json([
			'status' => 200,
			'products' => $product::has('category')
				->with('image', 'category')
				->orderBy('created_at', 'desc')
				->get()
			]);
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
