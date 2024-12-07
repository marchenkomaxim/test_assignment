<?php

//namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//
//class LoginController extends Controller
//{
//    use AuthenticatesUsers;
//    protected $redirectTo = '/home';
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//        $this->middleware('auth')->only('logout');
//    }
//}

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Проверка входных данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Попытка авторизации
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Неверный email или пароль',
            ], 401);
        }

        // Получение пользователя
        $user = Auth::user();

        // Генерация токена
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // Удалить все токены пользователя

        return response()->json([
            'message' => 'Вы вышли из системы',
        ], 200);
    }
}
