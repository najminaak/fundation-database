<?php

namespace App\Service\Event;

use App\Models\EventPhoto;
use Illuminate\Database\Eloquent\Collection;

interface EventPhotoService {
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}