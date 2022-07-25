<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index()
    {
        $data = User::all();
        return response()->json([
            'message' => 'SUCCESS',
            'data' => $data
        ], 201);
    }

    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email or Password does not match to our record'
            ], 401);
        }

        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json([
            'message' => 'Login Success',
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
