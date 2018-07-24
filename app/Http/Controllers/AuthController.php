<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::where(['email' => $request->email])->first();

            $user->weight = (int)$user->weight;
            $user->height = (int)$user->height;

            return [
                'status' => 'success',
                'data' => $user
            ];
        } 
    }


    public function loginById(Request $request)
    {
    
        if (Auth::loginUsingId($request->id)) {

            $user = User::find($request->id);

            $user->weight = (int)$user->weight;
            $user->height = (int)$user->height;

            return [
                'status' => 'success',
                'data' => $user
            ];
        } 
    }
}
