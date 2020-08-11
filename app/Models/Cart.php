<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'total_price'
	];

	public function user()
	{
			return $this->belongsTo(User::class);
	}

	public function details()
	{
			return $this->hasMany(Detail::class);
	}

}
