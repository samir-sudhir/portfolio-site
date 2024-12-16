<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class AuthController extends Controller
{
    // Login Method    
    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
       $user = auth()->user();

    $data = [
        'username' => $user->name, // Assuming 'name' is the username field
        'email' => $user->email,
        'token' => $token
    ];

    return Helper::result("User logged in successfully", 200,  $data);
}

       
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return Helper::result("Successfully logged out",200);
        } catch (JWTException $e) {
            return Helper::result("Could not log out",400);
        }
    }

    
}

