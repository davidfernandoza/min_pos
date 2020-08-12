<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'body', 'user_id', 'product_id'
	];

	public function product()
	{
			return $this->belongsTo(Product::class);
	}

	public function user()
	{
			return $this->belongsTo(User::class);
	}
}
