<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request){

        $post_data = $request->validate([
            'name'=>'required|string',
            'password'=>'required|string',
            'address'=>'required|string',
            'postal_code'=>'required|string',
            'city'=>'required|string',
            'email'=>'required|string|unique:users',
            'cpr_number'=>'required|integer',
        ]);

        return response()->json([
            'token_type' => 'Bearer'
        ]);

        $user = User::create([
            'name' => $post_data['name'],
            'address' => $post_data['address'],
            'postal_code' => $post_data['postal_code'],
            'city' => $post_data['city'],
            'cpr_number' => $post_data['cpr_number'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password']),
        ]);


        // get current time and add an hour
        $expirationsDate = Carbon::now()->addHour();

        // create a token
        $token = $user->createToken('authToken', ['*'], $expirationsDate)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request){
        if (!\Auth::attempt($request->only('name', 'password'))) {
            return response()->json([
                'message' => 'Login information is invalid.'
            ], 401);
        }

        $user = User::where('name', $request['name'])->firstOrFail();

        // get current time and add an hour
        $expirationsDate = Carbon::now()->addHour();

        // create a token
        $token = $user->createToken('authToken', ['*'], $expirationsDate)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
