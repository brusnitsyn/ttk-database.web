<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name" => 'required|string',
            "email" => 'required|string|unique:users,email',
            "password" => 'required|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('web')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string']
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Logged in Successfully.'
            ], 201);
        } else {
            throw ValidationException::withMessages([
                'email' => 'Неверный пароль.'
            ]);
        }
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return 'Logged Out';
        }
    }
}
