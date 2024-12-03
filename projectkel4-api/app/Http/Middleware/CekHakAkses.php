<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;

class CekHakAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->input('token') == 'my-secret-token') {
            return $next($request);
        }
        abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    }
}
