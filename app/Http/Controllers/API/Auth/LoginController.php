<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Service\Auth\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try {
            return new ApiResponse('success', __('validation.message.logged_in'), $this->authService->login($request), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, is_int($exception->getCode()) && $exception->getCode() >= 100 && $exception->getCode() <= 599 ? $exception->getCode() : 500);
        }
    }
    
    public function logout(Request $request)
    {
        try {
            Auth::user()->tokens()->delete();
            return new ApiResponse('success', __('validation.message.logged_out'), $this->authService->logout($request), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error', $exception->getMessage(), null, is_int($exception->getCode()) && $exception->getCode() >= 100 && $exception->getCode() <= 599 ? $exception->getCode() : 500);
        }
    }
    

}
