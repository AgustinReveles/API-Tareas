<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthenticateWithAuthApi
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $response = Http::withToken($token)
            ->get(config('services.api_autenticacion.url') . '/api/user');

        if (! $response->successful()) {
            return response()->json(['error' => 'No autorizado'], 401);
        }
        $userData = $response->json();
        $request->setUserResolver(function () use ($userData) {
            return (object) $userData;
        });

        return $next($request);
    }
}
