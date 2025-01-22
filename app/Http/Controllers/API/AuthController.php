<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|string|min:6",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "Validation Errors.",
                "data" => $validator->errors()->all()
            ]);
        }

        // Create user
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            // "password" => bcrypt($request->password),
            "password" => Hash::make($request->password),
        ]);

        // Check if user is created and token is generated
        if ($user) {
            $token = $user->createToken("MyApp")->plainTextToken;

            return response()->json([
                "status" => 1,
                "message" => "User Registered.",
                "data" => [
                    "name" => $user->name,
                    "email" => $user->email,
                    "token" => $token,
                ],
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "User Registration Failed."
            ], 500);
        }
    }


    // login
    public function login(Request $request)
    {

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $user = Auth::user();
            $response = [];
            $response["token"] = $user->createToken("MyApp")->plainTextToken;
            $response["name"] = $user->name;
            $response["email"] = $user->email;
            return response()->json([
                "status" => 1,
                "success" => true,
                "message" => "User registered.",
                "data" => $response
            ]);
        } else {
            return response()->json([
                "status" => 0,
                // "success" => false,
                "message" => "Authorization Error.",
                "data" => null
            ]);
        }
    }
}
