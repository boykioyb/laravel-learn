<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function create(Request $request){
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
