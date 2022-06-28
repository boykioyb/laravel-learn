<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
//
//        $user = User::query()->where('username', $username)->first();
//
//        if (!$user instanceof User) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Username không tồn tại'
//            ]);
//        }
//
//        if (!Hash::check($password, $user->password)) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Password không trùng nhau'
//            ]);
//        }
//
//        $user->token = $user->createToken('web');
//        dd($user);

        if (Auth::attempt(['email' => $email,'password' => $password])){
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with([
            'message' => "Tài khoản hoặc mật khẩu không đúng"
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $params = $request->only(['fullname', 'email', 'username', 'password']);

        $params['password'] = Hash::make($params['password']);
        $params['name'] = $params['fullname'];
        unset($params['fullname']);
        User::query()->create($params);

        return redirect()->route('login');
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
