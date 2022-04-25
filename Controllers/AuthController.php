<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // methode d'inscription
    public function signin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255|unique:users',
            'avatar' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required',
        ]);

        $users = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'avatar' => $request->avatar,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'msg'=>'Utilisateur creation reussi',
            'status_code' => 200,
            'utilisateur'=> $users
            ]);
            
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
            'email' => 'email|required',
            'password' => 'required'
            ]);
            
            $credentials = request(['email', 'password']);
            
            if (!Auth::attempt($credentials)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Utilisateur inexistant'
            ]);
            }
            
            $user = User::where('email', $request->email)->first();

            $tokenData = $user->createToken('authToken')->accessToken;
                        
                return response()->json([
                'user' => $user,
                'access_token' => $tokenData,
                'token_type' => 'Bearer',
                'token_scope' => null,
                'status_code' => 200
                ], 200);
            
            
        } catch (Exception $error) {
            return response()->json([
            'status_code' => 500,
            'message' => 'Utilisateur inexistant',
            'error' => $error,
            ]);
        }
    
    }
    public function logout(Request $request)
    {
    	$request->user()->token()->revoke();
    	return response()->json([
			'message'     => 'Logout successfully!',
			'status_code' => 200
		], 200);
    }

    public function profil(Request $request)
    {
    	if ($request->user()) {
    		return response()->json($request->user(), 200);
    	}

    	return response()->json([
			'message'     => 'Not logged in',
			'status_code' => 500
		], 500);
    }

}