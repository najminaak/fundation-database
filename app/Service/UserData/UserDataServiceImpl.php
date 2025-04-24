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
        // Mendapatkan data dari repository
        $userData = $this->userDataRepository->findById($userId);
    
        // Memastikan data ditemukan dan melakukan eager loading terhadap relasi 'user'
        if ($userData) {
            // Mengakses relasi 'user' untuk mendapatkan data dari tabel users
            $user = $userData->user; // Mengambil data relasi user (misalnya email)
            
            // Mengembalikan data yang lebih lengkap, termasuk email
            return [
                'id' => $userData->id,
                'full_name' => $userData->full_name, // Asumsi ada di tabel user_data
                'phone' => $userData->phone,         // Asumsi ada di tabel user_data
                'email' => $user ? $user->email : null, // Mengambil email dari tabel users
                'created_at' => $userData->created_at,
                'updated_at' => $userData->updated_at,
            ];
        }
    
        return null;
    }
    
}
