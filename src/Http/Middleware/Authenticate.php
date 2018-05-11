<?php


namespace Cblink\Process\Http\Middleware;


use Cblink\Queuer\Auth;

class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|null
     */
    public function handle($request, $next)
    {
        return Auth::check($request) ? $next($request) : abort(403);
    }
}