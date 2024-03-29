<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){

        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function login(Request $request){

        $user = User::where('email', $request->email)->first();

        if(!$user || Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'token' => $token
        ];

        //return response($response, 201)->withHeaders(['X-Header-Token' => 'Header Value']);
        return response($response)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token
            ]);
    }

    public function verify(Request $request){
      return $request->user();
    }
}
