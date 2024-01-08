<?php

namespace App\Http\Middleware;

use Closure;

class DisableBackBtn
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
        $reponse = $next($request);
        $reponse->headers->set('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
        $reponse->headers->set('Pragma', 'no-cache');
        $reponse->headers->set('Expires', date("H"));
        return $reponse;
    }
}
