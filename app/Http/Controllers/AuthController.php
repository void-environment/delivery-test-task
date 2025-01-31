<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\Login\LoginRequest;

use App\Http\Responses\Login\LoginResponse;
use App\Http\Responses\NoContentResponse;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


/**
 * Контроллер аутентификации пользователей.
 * @use \Laravel\Sanctum\HasApiTokens
 */
class AuthController extends Controller
{
    /**
     * Авторизация пользователя.
     *
     * @param LoginRequest $request
     * @return LoginResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request) : LoginResponse
    {
        $user = User::firstWhere('email', $request->email);

        return new LoginResponse(
            $user->createToken('api-token')->plainTextToken
        );
    }

    /**
     * Завершение сеанса (выход).
     *
     * @param Request $request
     * @return NoContentResponse
     */
    public function logout(Request $request) : NoContentResponse
    {
        $request->user()->tokens()->delete();

        return new NoContentResponse();
    }
}
