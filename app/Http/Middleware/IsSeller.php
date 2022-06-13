<?php
/**
 * Created by PhpStorm.
 * User: Farhad
 * Date: 9/24/2019
 * Time: 10:22 AM
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class IsSeller
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->level == 'seller') {
            return $next($request);
        }

        return redirect('/');
    }
}