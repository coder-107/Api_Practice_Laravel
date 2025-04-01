<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        // Assign default role if not specified
        $defaultRole = Role::where('name', 'user')->first();
        if ($defaultRole) {
            $user->assignRole($defaultRole);
        }

        return response()->json([
            'message' => 'Registration successful!',
            'role' => $defaultRole ? $defaultRole->name : 'No role assigned'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'These credentials do not match our records.'
            ], 401);
        }

        // Check if user has at least one role assigned
        if ($user->roles->isEmpty()) {
            return response()->json([
                'message' => 'User has no assigned role.'
            ], 403);
        }

        // Generate access token
        $device = substr($request->userAgent() ?? '', 0, 255);
        $access_token = $user->createToken($device)->plainTextToken;

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles->pluck('name')->first()
            ],
            'access_token' => $access_token,
            'message' => 'Login successful!'
        ]);
    }
}
