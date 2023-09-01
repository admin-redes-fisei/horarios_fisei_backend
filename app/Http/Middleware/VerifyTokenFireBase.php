<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $userId = $request->header('Authorization');

        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));

        $auth = $factory->createAuth();

        $user = $auth->getUser($userId);


        $email = $user->email;
        // $name = $user->displayName;

        // $userDB = User::where('email', $email)->get();

        if (User::where('email', $email)->get()->count() > 0) {
            return $next($request);
        }else{
            return response()->json(['error' => 'Not exists User'], Response::HTTP_BAD_REQUEST);
        }
    }
}
