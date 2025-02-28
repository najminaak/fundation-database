<?php

namespace App\Repository\Event;

use App\Interfaces\EventRepositorye;
use App\Models\Event;

class EventRepositoryImpl implements EventRepository
{
    public function getAllEvents()
    {
        return Event::all();
    }

    public function getEventById(int $id)
    {
        return Event::findOrFail($id);
    }

    public function createEvent(array $data)
    {
        return Event::create($data);
    }

    public function updateEvent(int $id, array $data)
    {
        $event = Event::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function deleteEvent(int $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return true;
    }
}