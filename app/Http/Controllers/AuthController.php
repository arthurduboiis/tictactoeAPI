<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = auth()->user();
            if ($user instanceof \App\Models\User) {
                $deviceName = $request->filled('device_name') ? $request->device_name : 'token_default';
                $token = $user->createToken($deviceName)->plainTextToken;

                return response()->json([
                    'message' => Lang::get('auth.login'),
                    'user' => $user,
                    'token' => $token,
                ]);
            } else {
                return response()->json(['error' => 'Utilisateur non authentifié'], 401);
            }
        }

        return response()->json(['error' => 'Identifiants invalides'], 401);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
