<?php

namespace App\Service\UserData;

use App\Models\UserData;
use App\Repository\UserData\UserDataRepository;
use Exception;

class UserDataServiceImpl implements UserDataService
{
    protected $userDataRepository;

    public function __construct(UserDataRepository $userDataRepository)
    {
        $this->userDataRepository = $userDataRepository;
    }

    public function updateUserData(array $data, $userId)
    {
        try {
            // Melakukan update data
            $updatedData = $this->userDataRepository->fillUpdateById($data, $userId);
            return $updatedData;
        } catch (\Exception $e) {
            // Log error secara lebih detail
            \Log::error('Error updating user data for user ID: ' . $userId, [
                'exception_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'data' => $data, // Cek data yang dikirimkan
            ]);
            

        }
    }
    public function getUserDataById($userId)
    {
        return $this->userDataRepository->findById($userId);
    }
}
