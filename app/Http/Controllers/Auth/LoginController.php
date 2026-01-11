<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        if ($user->exists()) {
            if (! Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'message' => 'Credentials incorrect. Please try again.',
                ]);
            }

            $token = $user->createToken('token', ['*'], Carbon::now()->addDay())->plainTextToken;

            return response()->json([
                'token' => $token,
            ]);
        }

    }
}
