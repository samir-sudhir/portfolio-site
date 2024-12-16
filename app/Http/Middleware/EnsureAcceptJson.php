<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAcceptJson
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
        // Check if the Accept header is not set to application/json
        if (!$request->header('Accept') || $request->header('Accept') != 'application/json') {
            // Force the header to be application/json
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
