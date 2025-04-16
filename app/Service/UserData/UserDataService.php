<?php

namespace App\Service\UserData;

use App\Http\Repository\UserData\UserDataRepository;

interface UserDataService
{
    public function updateUserData(array $data, $userId);
    public function getUserDataById($userId);

}