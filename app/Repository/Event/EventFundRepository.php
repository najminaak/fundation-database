<?php

namespace App\Repository\Event;

use App\Models\EventFund;

interface EventFundRepository
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}