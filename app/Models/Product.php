<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name','price', 'amount', 'description'
	];

	public function category()
	{
			return $this->belongsTo(Category::class);
	}

	public function comments()
	{
			return $this->hasMany(Comment::class);
	}

	public function details()
	{
			return $this->hasMany(Detail::class);
	}

	public function image()
	{
			return $this->morphOne(Image::class, 'imageable');
	}
}
