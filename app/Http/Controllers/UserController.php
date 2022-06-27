<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $user = User::query()->where('username', $username)->first();

        if (!$user instanceof User) {
            return response()->json([
                'status' => false,
                'message' => 'Username không tồn tại'
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password không trùng nhau'
            ]);
        }

        $user->token = $user->createToken('web');
        dd($user);
        return $user;

    }

    public function create(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return $user;
    }
}
