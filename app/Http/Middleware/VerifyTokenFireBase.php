<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class VerifyTokenFirebase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        $factory = (new Factory)->withServiceAccount('/google-services.json');

        $auth = $factory->createAuth();

        try {
            $verifiedIdToken = $auth->verifyIdToken($token);
        } catch (FailedToVerifyToken $e) {
            echo 'The token is invalid: ' . $e->getMessage();
        }

        $uid = $verifiedIdToken->claims()->get('sub');

        $user = $auth->getUser($uid);

        User::create([
            
        ]);

        return $next($request);
    }
}
