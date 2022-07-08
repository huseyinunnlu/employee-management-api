<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Get auhenticated user
    public function getUser()
    {
        return new UserResource(Auth::user());
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth()->user();
            $user->can_sign_in === 1 ?
                $token = 'Bearer ' . $user->createToken('Login')->accessToken
                : throw new AuthenticationException(trans('auth.login_not_allowed'));

            return $this->loginSuccessfully($user, $token);
        }
        throw new AuthenticationException(trans('auth.failed'));
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->authUserToken()->delete();
            return $this->logoutSuccessfully(trans('auth.logout'));
        }

        throw new AuthenticationException(trans('auth.logout_failed'));
    }
}
