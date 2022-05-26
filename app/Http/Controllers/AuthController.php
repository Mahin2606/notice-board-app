<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Services\AuthService;
use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        $password = $request->get('password');

        if (blank($user)) {
            throw ValidationException::withMessages(['email' => __('The email address or password that you entered is invalid.')]);
        }

        if (!$this->authService->checkPassword($user, $password)) {
            throw ValidationException::withMessages(['password' => __('The password that you entered does not match.')]);
        }

        Auth::login($user);
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('auth.login.form');
    }
}
