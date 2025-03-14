<?php

namespace App\Service\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Repository\User\UserRepository;
use App\Repository\UserData\UserDataRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AuthServiceImpl implements AuthService
{
    protected $userRepository;
    protected $userDataRepository;

    public function __construct(UserRepository $userRepository, UserDataRepository $userDataRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDataRepository = $userDataRepository;
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                Log::info('Invalid Credentials');
                throw new Exception('Invalid Credentials', 401); // Ensure integer code
            }
            $user = Auth::user();
            if ($user->status != 'active') {
                Log::info('User Inactive');
                throw new Exception('User Inactive', 401); // Ensure integer code
            }
            $scope = match ($user->role) {
                'entrepreneur' => ['entrepreneur'],
                'organizer' => ['organizer'],
                'admin' => ['admin'],
                default => []
            };
            $token = $user->createToken('authToken', $scope)->accessToken;
            $data = [
                'user' => LoginResource::make($user),
                'token' => $token,
            ];
            return $data;
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage(), (int) $exception->getCode()); // Ensure integer code
        }
    }

    public function organizerRegister(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $validatedData['role'] = 'organizer';
            $validatedData['status'] = 'active';
            $user = $this->userRepository->save($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500); // Ensure integer code
        }
        try {
            $validatedData['user_id'] = $user->id;
            $userData = $this->userDataRepository->save($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500); // Ensure integer code
        }
        DB::commit();

        $data = [
            'user' => $user,
            'user_data' => $userData,
        ];
        return $data;
    }

    public function entrepreneurRegister(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $validatedData['role'] = 'entrepreneur';
            $validatedData['status'] = 'active';
            $user = $this->userRepository->save($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500); // Ensure integer code
        }
        try {
            $validatedData['user_id'] = $user->id;
            $userData = $this->userDataRepository->save($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500); // Ensure integer code
        }
        DB::commit();

        $data = [
            'user' => $user,
            'user_data' => $userData,
        ];
        return $data;
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage(), (int) $exception->getCode());
        }
    }
    
    
}
