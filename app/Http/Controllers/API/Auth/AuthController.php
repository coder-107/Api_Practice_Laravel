<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' =>  ['required', 'confirmed', 'min:8']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        // $device = substr($request->userAgent() ?? '', 0, 255);

        return response()->json([
            // 'access_token' => $user->createToken($device)->plainTextToken,
            'message' => 'Registration successful!'
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            return response([
                'message' => ['These credentials do not match with our records.']
            ]);
        }

        $token = substr($request->userAgent() ?? '', 0, 255);
        $access_token = $user->CreateToken($token)->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $access_token,
            'message' => 'Login Successfully!'
        ]);
    }
}
