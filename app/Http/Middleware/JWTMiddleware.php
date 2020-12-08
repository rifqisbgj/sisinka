<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
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
        $msg = '';
        try {
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $msg = 'token expired';
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            $msg = 'invalid token';
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e){
            $msg = 'provide token';
        }

        return response()->json([
            'success' => false,
            'message' => $msg
        ]);
    }
}
