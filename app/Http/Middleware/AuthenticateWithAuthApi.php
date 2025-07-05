<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWithAuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next) {
        $response = Http::get(config('services.api_autenticacion.url').'/validate', [
            'token' => $request->bearerToken()
        ]);

        if ($response->status() !== 200) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        return $next($request);
}
}
