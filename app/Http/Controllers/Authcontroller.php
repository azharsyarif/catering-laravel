<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{
    public function register(Request $req){
        // Validate
        $rules =[
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:6'
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        // Create new user in users table
        $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
        ]);
        $token = $user->createToken('personal Access Token')->plainTextToken;
        $response = ['user'=> $user, 'token'=>$token];
        return response()->json($response,200);
    }

    public function login(Request $req){
        // validate
        $rules = [
            'email' => 'required',
            'password' => 'required|string',
        ];
        $req->validate($rules);
        // find user email in users table
        $user = User::where('email', $req->email)->first();
        // if user email found and password is correct
        if($user && Hash::check($req->password, $user->password)){
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            $response=['user'=>$user, 'token'=>$token];
            return response()->json($response, 200);
        }
        $response = ['message'=>'Incorrect email or password'];
        return response()->json($response, 400);
    }
}