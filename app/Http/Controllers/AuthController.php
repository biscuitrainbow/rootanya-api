<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Api\ApiController;

class AuthController extends ApiController
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $user->token = $user->createToken('RooTanYa')->accessToken;

            return $this->respond($user);
        } else {
            return $this->respondUnauthorized();
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->token()->revoke();

        return $this->respondSuccess();
    }
}
