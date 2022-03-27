<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Signin
     */
    public function signin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('GlassGuruSigninToken')->accessToken;
            return response()->json([
                'token' => $token
            ], 200);

        } else {
            return response()->json([
                'error' => 'Unauthorised'
            ], 401);
        }
    }

    /**
     * Signup
     */
    public function signup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        
        if($user){
            $token = $user->createToken('GlassGuruSignupToken')->accessToken; 
            return response()->json(
                ['token' => $token
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'User could not be created'
            ], 500);
        }
        
    }

}