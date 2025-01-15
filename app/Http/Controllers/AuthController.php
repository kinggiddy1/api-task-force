<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'Admin', 
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'token' => $token]);
    }

     // Login
     public function login(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'email' => 'required|email|exists:users,email',
             'password' => 'required'
         ]);
 
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 422);
         }
 
         $credentials = $request->only('email', 'password');
 
         if (!$token = JWTAuth::attempt($credentials)) {
             return response()->json([
                 'errors' => [
                   'password' =>['Provided password is incorrect.']
                 ]
             ], 401); 
         }
 
         return response()->json(['token' => $token]); 
     }
 
     // Logout
     public function logout()
     {
         auth()->logout();
         return response()->json(['message' => 'Successfully logged out']);
     }
}
