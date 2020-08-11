<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'price', 'amount', 'description'
	];

	public function category()
	{
			return $this->belongsTo(Category::class);
	}

	public function comment()
	{
			return $this->hasMany(Comment::class);
	}

	public function detail()
	{
			return $this->hasMany(Detail::class);
	}

	public function image()
	{
			return $this->morphOne(Image::class, 'imageable');
	}
}
