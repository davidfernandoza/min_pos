<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
		use Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'names', 'last_names', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
		];

	// Accessors and Mutators
		public function setPasswordAttribute($value)
		{
			$this->attributes['password'] = bcrypt($value);
		}


	// Relations
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
