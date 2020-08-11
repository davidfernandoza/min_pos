<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
		use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'names', 'last_names', 'email', 'password', 'rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
		];


		public function setPasswordAttribute($value)
		{
			$this->attributes['password'] = bcrypt($value);
		}

		public function carts()
		{
				return $this->hasMany(Cart::class);
		}

		public function comments()
		{
				return $this->hasMany(Comment::class);
		}

		public function image()
		{
				return $this->morphOne(Image::class, 'imageable');
		}
}
