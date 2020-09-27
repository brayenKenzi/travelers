<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user() && Auth::user()->roles == 'ADMIN') {
            return $next($request);
        //jika auth yang isinya admin = ROLESnya terisi admin maka kembalikan $next($request) perintah selanjutnya
        }
        return redirect('/');
        //jika tidak maka kembalikan ke home
    }
}
