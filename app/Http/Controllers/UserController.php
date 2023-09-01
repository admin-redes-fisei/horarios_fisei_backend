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
            User::create($request->all());
        }

        return response()->json(array("Create" => true));
    }
}
