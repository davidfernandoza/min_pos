<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'amount'
	];

	public function cart()
	{
			return $this->belongsTo(Cart::class);
	}

	public function product()
	{
			return $this->belongsTo(Product::class);
	}
}
