<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController
{
    public function Register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $responseData['data'] = [
            "name" => $user->name,
            "auth_token" => $user->createToken('TaskManager')->plainTextToken
        ];
        $responseData["success"] = true;
        $responseData["message"] = "Account Created Successfully!";
        return response()->json($responseData, 201);
    }

    public function Login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if($user){
                $responseData = [
                    'success' => true,
                    'message' => "Login Successfully!",
                    'data' => [
                        'auth_token' => $user->createToken('TaskManager')->plainTextToken,
                        'name' =>  $user->name
                    ]
                ];
                return response()->json($responseData, 200);
            }
            return response()->json([
                "message"=>"Unauthorized"
            ], 401);

        } else {
            return response()->json([
                "message"=>"Unauthorized"
            ], 401);
        }
    }
}
