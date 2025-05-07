<?php
namespace App\Service\Event;

use App\Repository\Event\EventRepository;
use App\Service\Event\EventService;

class EventServiceImpl implements EventService
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents()
    {
        return $this->eventRepository->getAllEvents();
    }

    public function getEventById(int $id)
    {
        return $this->eventRepository->getEventById($id);
    }

    public function createEvent(array $data)
    {
        return $this->eventRepository->createEvent($data);
    }

    public function updateEvent(int $id, array $data)
    {
        return $this->eventRepository->updateEvent($id, $data);
    }

    public function deleteEvent(int $id)
    {
        return $this->eventRepository->deleteEvent($id);
    }
    public function getPopularEvents(int $limit = 10)
    {
    return $this->eventRepository->getPopularEvents($limit);
    }

}
