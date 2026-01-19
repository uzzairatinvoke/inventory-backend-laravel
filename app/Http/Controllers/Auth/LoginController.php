<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if (! Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'message' => 'Credentials incorrect. Please try again.',
                ]);
            }
            $token = $user->createToken('token', ['*'], Carbon::now()->addDay())->plainTextToken;
            
            // Load user roles and permissions
            $user->load('roles', 'permissions');
            
            return response()->json([
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    // include roles and permissions in auth context
                    'roles' => $user->roles->pluck('name')->toArray(),
                    'permissions' => $user->getAllPermissions()->pluck('name')->toArray(),
                ],
            ]);
        }

        return response()->json([
            'message' => 'the user does not exist',
        ]);

    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'message' => "You've log out successfully",
        ]);
    }
}
