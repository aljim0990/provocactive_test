<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
class Role
{
      public function handle($request, Closure $next,$role)
    {

        if (strpos($role, Auth::user()->role) !== false) {

            return $next($request);
        }
        return redirect()->route('home');
        
    }
}
