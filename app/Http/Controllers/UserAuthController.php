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

    public function unauthorized(){
        return response()->json([
            'message'=>"Unauthorized"
        ], 401);
    }

    public function getUsers(){
        $users = User::all();
        return response()->json([
            'users'=>$users
        ]);
    }
    public function login(Request $request)
    {
        // validate the request and return the error if any validation fails as a json response
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // get the user by email
        $user = User::where('email', $request->email)->first();

        // check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        // generate a token for the user
        $token = $user->createToken('my-app-token')->plainTextToken;

        // return the token as a json response
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);

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
        return response()->json(
            $response, 201
        );
    }

    public function logout(){

        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];


    }

}
