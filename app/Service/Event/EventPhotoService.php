<?php

namespace App\Services;

use App\Models\EventPhoto;
use Illuminate\Database\Eloquent\Collection;

class EventPhotoService
{
    public function getAll(): Collection
    {
        return EventPhoto::all();
    }

    public function getById(int $id): ?EventPhoto
    {
        return EventPhoto::findOrFail($id);
    }

    public function create(array $data): EventPhoto
    {
        return EventPhoto::create($data);
    }

    public function update(int $id, array $data): EventPhoto
    {
        $eventPhoto = EventPhoto::findOrFail($id);
        $eventPhoto->update($data);
        return $eventPhoto;
    }

    public function delete(int $id): bool
    {
        $eventPhoto = EventPhoto::findOrFail($id);
        return $eventPhoto->delete();
    }
}
