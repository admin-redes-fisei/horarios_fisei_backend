<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Factory;

class VerifyTokenFirebase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
       

        $userId = $request->header('Authorization');



        if (!$userId) {
            return response()->json(array('Not Authorization'));
        }

        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));


        $auth = $factory->createAuth();

        try {
            $verifiedIdToken = $auth->verifyIdToken($userId);

            $uid = $verifiedIdToken->claims()->get('sub');

            $user = $auth->getUser($uid);

        } catch (FailedToVerifyToken $e) {
            return response()->json(['error' => 'Invalid token'], Response::HTTP_BAD_REQUEST);
        }

        $email = $user->email;

        $userModel = User::where('email', $email)->first();

        if ($userModel != null) {
            foreach ($roles as $role) {
                if ($userModel->hasRole($role)) {
                    return $next($request);
                }
            }
            return response()->json(['error' => 'User doesn\'t have permision to make this request'], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['error' => 'Not exists User'], Response::HTTP_BAD_REQUEST);
        }
    }
}
