<?php

namespace App\Repository\Event;

use App\Repository\Event\EventRepository;
use App\Models\Event;

class EventRepositoryImpl implements EventRepository
{
    protected $withRelations = [
        'organizer',
        'organizer.organization',
        'eventPhotos',
        'eventCategories',
        'categories',
        'eventFund',
        'eventPlacement',
        'kontraprestasis',
        'sponsors',
        'participantCategories'
    ];

    public function getAllEvents()
    {
        return Event::with($this->withRelations)->get();
    }

    public function getEventById(int $id)
    {
        return Event::with($this->withRelations)->findOrFail($id);
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
    public function getPopularEvents(int $limit = 10)
    {
    return Event::orderByDesc('click_count')->take($limit)->get();
    }

}
