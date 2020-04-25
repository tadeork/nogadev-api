<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PassportController extends Controller
{
    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('nogadev-api')->accessToken;

        return respondWithToken($token);
    }

    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'invalid credentials'], 401);
        }

        $user = auth()->user();
         $token = $user->createToken('nogadev-api');
         return response()->json(['token' => $token]);
        // return $this->respondWithToken($user->createToken('nogadev-api'));
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => ''
        ]);
    }
}
