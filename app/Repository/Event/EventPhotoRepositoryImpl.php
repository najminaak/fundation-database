<?php

namespace App\Repository\Event;

use App\Models\Event;

class EventPhotoRepositoryImpl implements EventPhotoRepository{
    public function getAll()
    {
        return EventPhoto::all();
    }

    public function getById($id)
    {
        return EventPhoto::findOrFail($id);
    }

    public function create($data)
    {
        return EventPhoto::create($data);
    }

    public function update($id, $data)
    {
        $photo = EventPhoto::findOrFail($id);
        $photo->update($data);
        return $photo;
    }

    public function delete($id)
    {
        return EventPhoto::destroy($id);
    }
}