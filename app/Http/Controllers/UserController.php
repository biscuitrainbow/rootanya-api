<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Medicine;
use App\UserHasNotification;
use App\UserHasMedicine;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Validation\Rule;

class UserController extends ApiController
{
    public function detail(Request $request)
    {
        $user = auth()->user();
        return $user;
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'gender' => ['required', Rule::in(['หญิง', 'ชาย'])],
            'age' => 'min:1|max:100',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'height' => $request->height,
            'weight' => $request->weight,
            'tel' => $request->tel,
            'intolerance' => $request->intolerance,
            'medicine' => $request->medicine,
            'disease' => $request->disease,
        ]);

        return $this->respondSuccess();
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'gender' => ['required', Rule::in(['หญิง', 'ชาย'])],
            'age' => 'min:1|max:100',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'height' => $request->height,
            'weight' => $request->weight,
            'intolerance' => $request->intolerance,
            'medicine' => $request->medicine,
            'disease' => $request->disease,
        ]);

        $user->token = $user->createToken('RooTanYa')->accessToken;

        return $this->respondCreated($user);
    }
}
