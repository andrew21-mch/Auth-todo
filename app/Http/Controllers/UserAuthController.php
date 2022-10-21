<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//hash
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller

{

    public function home(){
        return response()->json([
            'message'=>"This is a todo API"
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'message' => 'UNo such user found'
            ], 404);
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Incorrect password'
            ], 404);
        }
        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);

    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function logout(){

        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
        

    }

}
