<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
	public function getAllByProduct($idProduct)
	{
		$comments = Comment::with('user.image')
		->where('product_id', $idProduct)
		->orderBy('id', 'desc')
		->get();
		return response()->json($comments);
	}

	public function store(User $user, CommentRequest $request)
	{
		$comment = $user->comments()->save(new Comment($request->all()));
		$comment->load('user.image');
		return response()->json($comment);
	}
}
