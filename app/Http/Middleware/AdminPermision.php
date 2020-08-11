<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminPermision
{

	public function handle($request, Closure $next)
	{
		if(Auth::user()->rol != 'ADMIN'){
			return redirect('/');
		}
		return $next($request);
	}
}
