<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /** List of allowed origin URLs */
    private $allowedOrigins = [
        "dev14.v12dev.com",
        "api.vau.company"
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
        $response = $next($request);        

        // Set the allowed origin URL
        $origin = !is_null($request->server('HTTP_REFERER')) ? $request->server('HTTP_REFERER') : $request->headers->get('origin');
        $origin = parse_url($origin);
        if(isset($origin['host']) && in_array($origin['host'], $this->allowedOrigins)){
            // Add headers to the response
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Origin, Authorization, X-Requested-With, X-Auth-Token');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Origin', $origin['scheme'] . '://' . $origin['host'] . (isset($origin['port']) ? ':' . $origin['port'] : ''));
        }

        return $response;
    }
}
