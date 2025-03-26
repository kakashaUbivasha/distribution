<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request, AuthService $authService)
    {
        try{
            $result = $authService->login($request->email, $request->password);
            return response($result, 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }
    public function register(RegisterRequest $request)
    {
        try{
            User::create($request->validated());
            return response()->json(['massage'=>'пользователь создан'], 201);
        }
        catch(ValidationException $e){
            return response()->json([$e],400);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Вы вышли из системы'], 200);
    }

}
