<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {


        $user = User::where('email', $request->email)->first();


        if (!$user) {
            $user = User::create($request->all());

            $user->roles()->attach(2);  
        }

        return response()->json(array("Create" => true));
    }
}
