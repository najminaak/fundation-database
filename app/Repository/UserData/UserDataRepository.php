<?php

namespace App\Repository\UserData;

interface UserDataRepository
{
    public function save($data);

    public function fillUpdateById(array $data, $userId);  // Pastikan menerima parameter $userId
    
    public function findById($userId); // Tambahkan ini untuk ambil data
}