<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        // if(!auth()->user()->admin)
        // dd($request->user());

        // if(!auth()->user()->isAdmin())
        if(! optional($request->user())->isAdmin())
        {
            return response()->view('forbidden', [], 403); //Forbhiden
        }
        return $next($request);
    }
}
