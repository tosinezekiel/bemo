<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\HasResponse;
use Illuminate\Http\Request;

class CardRetrievalMiddleware
{
    use HasResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->filled('access_token') && !$request->has('access_token')){
            return $this->error("Please specify an access token.", []);
        }

        if($request->input('access_token') !== config('app.access_token')){
            return $this->error("You have a wrong access token.", []);
        }

        return $next($request);
    }
}
