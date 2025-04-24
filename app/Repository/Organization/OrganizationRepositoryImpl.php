<?php

namespace App\Repository\Organization;

use App\Models\Organization;

class OrganizationRepositoryImpl implements OrganizationRepository
{
    public function save($data)
    {
        return Organization::create($data);
    }

    public function findAll()
    {
        return Organization::all();
    }

    public function findById($id)
    {
        return Organization::findOrFail($id);
    }

    public function update($data, $id)
    {
        Organization::where('id', $id)->update($data);
        return $this->findById($id);
    }
    public function findByUserId($user_id)
    {
        return Organization::where('user_id', $user_id)->first();
    }
}