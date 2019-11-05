<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /** List of allowed origin URLs */
    private $allowedOrigins = [
        "https://dev14.v12dev.com/"
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Add headers to the response
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Origin, Authorization, X-Requested-With, X-Auth-Token');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        // Set the allowed origin URL
        if(in_array($request->server('HTTP_ORIGIN'), $this->allowedOrigins))
            $response->headers->set('Access-Control-Allow-Origin', $request->server('HTTP_ORIGIN'));

        return $response;
    }
}
