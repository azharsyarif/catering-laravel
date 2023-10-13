<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
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
        $response = ['user'=> $user, 'token'=>$token, 'message' => 'Register Berhasil'];
        return response()->json($response,200);
    }
    
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);
    
    //     try {
    //         $cred = new User();
    //         $cred->name = $request->name;
    //         $cred->email = $request->email;
    //         $cred->password = Hash::make($request->password);
    //         $cred->save();
    //         $response = ['status' => 200, 'message' => 'Register Berhasil'];
    //         return response()->json($response, 200);
    //     } catch (Exception $e) {
    //         $response = ['status' => 500, 'message' => $e->getMessage()];
    //         return response()->json($response, 500);
    //     }
    // }
    




    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
    
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken('personal-access-token')->plainTextToken;
            $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Login berhasil'];
            return response()->json($response, 200);
        } else if(!$user) {
            $response = ['status' => 404, 'message' => 'Akun tidak ditemukan dengan email ini'];
            return response()->json($response, 404);
        } else {
            $response = ['status' => 401, 'message' => 'Email atau password Anda salah! Silahkan coba lagi'];
            return response()->json($response, 401);
        }
    }

}



/* CODE LAMA

    // public function login(Request $req){
    //     // validate
    //     $rules = [
    //         'email' => 'required',
    //         'password' => 'required|string',
    //     ];
    //     $req->validate($rules);
    //     // find user email in users table
    //     $user = User::where('email', $req->email)->first();
    //     // if user email found and password is correct
    //     if($user && Hash::check($req->password, $user->password)){
    //         $token = $user->createToken('Personal Access Token')->plainTextToken;
    //         $response=['user'=>$user, 'token'=>$token];
    //         return response()->json($response, 200);
    //     }
    //     $response = ['message'=>'Incorrect email or password'];
    //     return response()->json($response, 400);
    // }