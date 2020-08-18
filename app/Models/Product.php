<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name','price', 'amount', 'description', 'category_id'
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

	// Scopes

	public function scopeName($query, $name)
	{
		if ($name) return $query->orWhere('name', 'LIKE', '%'.$name.'%');
	}

	public function scopeDescription($query, $description)
	{
		if ($description) return $query->orWhere('description', 'LIKE', '%'.$description.'%');
	}
}
