<?php

namespace App\Repository\Event;

use App\Models\Event;

interface EventPhotoRepository{
    public function getAll();
    public function getById($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}