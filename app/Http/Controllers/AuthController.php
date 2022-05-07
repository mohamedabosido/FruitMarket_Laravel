<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=> 'required|string',
            'address'=> 'required|string',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' =>$request->address,
        ]);
        $token = $user->createToken('myapp')->plainTextToken;
        $response = [
            'user' =>$user,
            'token' =>$token,
        ];
        return response($response ,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=> 'required|string',
            'password'=> 'required|string',
        ]);

        $user= User::where('email' , $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message' =>'Bad creds',
            ],401);
        }

        $token = $user->createToken('myapp')->plainTextToken;
        $response = [
            'user' =>$user,
            'token' =>$token,
        ];
        return response($response ,200);
    }



    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        $response = [
            'meaage' =>'looged out'
        ];
        return response($response,200);
    }
}
