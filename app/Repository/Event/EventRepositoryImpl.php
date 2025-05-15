<?php

namespace App\Repository\Event;

use App\Models\Event;

class EventRepositoryImpl implements EventRepository
{
    public function getAllEvents()
    {
        return Event::with([
            'organizer.organization',
            'eventPhotos',
            'categories',
            'eventFund',
            'eventPlacement',
            'kontraprestasis',
            'sponsors',
            'participantCategories'
        ])->get();
    }

    public function getEventById(int $id)
    {
        return Event::with([
            'organizer.organization',
            'eventPhotos',
            'categories',
            'eventFund',
            'eventPlacement',
            'kontraprestasis',
            'sponsors',
            'participantCategories'
        ])->findOrFail($id);
    }

    public function createEvent(array $data)
    {
        // Dibiarkan kosong karena sudah di-handle oleh EventServiceImpl
        // Bisa juga lempar Exception agar tidak dipakai langsung
        throw new \Exception("Use EventServiceImpl for event creation logic.");
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
        return Event::with([
            'organizer.organization',
            'eventPhotos',
            'categories',
            'eventFund',
            'eventPlacement',
            'kontraprestasis',
            'sponsors',
            'participantCategories'
        ])->orderByDesc('click_count')->take($limit)->get();
    }
}
