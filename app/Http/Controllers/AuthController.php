<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'required',
        ]);
        if ($validators->fails()) {
            return response()->json($validators->errors(), 403);
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => "Les identifiants de connexion sont invalides..."], 403);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $request->user()->createToken($request->device);

            return response()->json(['token' => $token->plainTextToken, 'user' => $request->user()], 200);

        }
    }
}
