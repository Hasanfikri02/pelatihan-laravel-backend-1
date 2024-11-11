<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]); 

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil registrasi silahkan login',
            'data' => $user
        ], 201);

    }
    public function login(Request $request){ 
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]); 
 
        if (Auth::attempt($credentials)) {  
            $token = $request->user()->createToken('myApp');
 
            return response()->json([
                "status" => "success",
                "message" => "Berhasil Login",
                "data" => [
                    'name' => Auth::user()->name, 
                    'email' => Auth::user()->email
                ],
                "token" => $token->plainTextToken
            ], 200); 
        }
        return response()->json([
            'status' => 'error',
            "message" => "Username atau Email salah"
        ],401);
    }
    public function logout(Request $request)
    { 
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ], 200);
    }
}