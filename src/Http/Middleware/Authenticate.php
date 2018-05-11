<?php


namespace Cblink\Process\Http\Middleware;


use Cblink\Process\ProcessGuard;

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
        return ProcessGuard::check($request) ? $next($request) : abort(403);
    }
}