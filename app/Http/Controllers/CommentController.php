<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
	public function getAllByProduct(Product $product)
	{
		return response()->json($product::with(['comments' => function ($query){
			return $query->orderBy('id', 'desc')->with('user.image');
		}])->find($product->id));
	}


	public function store(User $user, CommentRequest $request)
	{
		// TODO: como retornar un objeto con todos los campos?
		$comment = $user->comments()->save(new Comment($request->all()));
		return response()->json(['comment' => $comment->load('user.image')]);
	}
}
