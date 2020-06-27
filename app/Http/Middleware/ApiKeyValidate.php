<?php

namespace App\Http\Middleware;

use Closure;

class ApiKeyValidate
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
        if (!$request->has("api_key")) {
            return response()->json([
              'status' => 401,
              'message' => 'Unauthorized access!',
            ], 401);
        }
      
        if ($request->has("api_key")) {
            $api_key = "ZxwNWzyogRMMgDNHeGNbaBQFXuGCbv4m7lPPlYct91sO3DUNkw";
            if ($request->input("api_key") != $api_key) {
                return response()->json([
                'status' => 401,
                'message' => 'Unauthorized access!',
              ], 401);
            }
        }
      
        return $next($request);
    }
}
