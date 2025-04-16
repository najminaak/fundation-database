<?php

namespace App\Repository\UserData;

use App\Models\UserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Pastikan untuk mengimpor Log

class UserDataRepositoryImpl implements UserDataRepository
{
    public function save($data)
    {
        // Log sebelum menyimpan data
        Log::debug('Saving new user data', ['data' => $data]);

        return UserData::create($data);
    }

    public function fillUpdateById($data, $userId)
    {
        // Log data yang diterima
        Log::debug('Received data for updating user', ['data' => $data, 'userId' => $userId]);

        // Mengambil ID pengguna yang sedang login
        $id = auth('api')->user()->id;

        // Log untuk memverifikasi ID pengguna
        Log::debug('User ID (authenticated): ' . $id);

        try {
            // Mencari data pengguna berdasarkan ID
            $user = UserData::findOrFail($id);
            Log::debug('User found for ID: ' . $id, ['user' => $user]);

            // Mengisi data ke model UserData
            $user->fill($data);
            Log::debug('User data filled with new values', ['filled_data' => $user->toArray()]);

            // Menyimpan data
            $user->save();
            Log::debug('User data saved successfully', ['user' => $user]);

            // Mengambil kembali data pengguna yang telah diperbarui
            $updatedUser = UserData::find($id);
            Log::debug('User data after update', ['updated_user' => $updatedUser]);

            return $updatedUser;
        } catch (\Exception $e) {
            // Log error jika terjadi exception
            Log::error('Error updating user data', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
    public function findById($userId)
    {
        return UserData::where('user_id', $userId)->first();
    }   
}
