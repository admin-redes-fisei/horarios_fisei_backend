<?php

namespace App\Http\Middleware;

use Closure;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Symfony\Component\HttpFoundation\Response;

class VerifyTokenFirebase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica el token de Firebase aquí
        $token = $request->header('Authorization');

        try {
           
            

            return $next($request);
        } catch (\Throwable $e) {
            // El token no es válido, devuelve una respuesta de error
            return response()->json(['error' => 'Token inválido'], 401);
        }
    }
}
