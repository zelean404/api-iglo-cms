<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserManage;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = UserManage::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'nama' => $user->nama,
                    'email' => $user->email,
                    'id_role' => $user->id_role,
                ]
            ]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // protected function respondWithToken($token)
    // {
    //     $user = Auth::guard('api')->user();
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //         'expires_in' => config('jwt.ttl') * 60,
    //         'user' => [
    //             'id' => $user->id,
    //             'nama' => $user->nama,
    //             'email' => $user->email,
    //             'id_role' => $user->id_role,
    //         ]
    //     ]);
    // }





}
