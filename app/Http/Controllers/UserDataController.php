<?php
namespace App\Http\Controllers;

use App\Service\UserData\UserDataService;
use App\Service\UserData\UserDataServiceImpl;
use App\Http\Requests\UserData\UserDataRequest; // Import FormRequest
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    protected $userDataService;

    public function __construct(UserDataService $userDataService)
    {
        $this->userDataService = $userDataService;
    }

    public function updateUserData(UserDataRequest $request) // Ganti Request dengan UpdateUserDataRequest
    {
        
        // Mendapatkan data yang sudah divalidasi
        $validatedData = $request->validated();

        // Ambil user ID dari autentikasi
        $userId = auth()->user()->id;
        \Log::debug('Received user ID: ' . $userId);
        // Cek request body
        \Log::debug('Request Data: ', $request->all()); 
        // Update data melalui service
        $updatedUserData = $this->userDataService->updateUserData($validatedData, $userId);
            
        return response()->json([
            'status' => 'success',
            'data' => $updatedUserData,
        ]);
    }
    public function showUserData($user_id)
    {
        $userData = $this->userDataService->getUserDataById($user_id);

        return response()->json([
            'message' => 'User data retrieved successfully',
            'data' => $userData
        ]);
    }
}
