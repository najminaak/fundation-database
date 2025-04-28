<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Service\Event\EventService;
use App\Service\Event\EventServiceImpl;


class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventServiceImpl $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return response()->json($events);
    }

    public function show($id)
    {
        $event = $this->eventService->getEventById($id);
        return response()->json($event);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'organizers_id' => 'required|exists:organizations,id',
            'title' => 'required|string|max:100',
            'type_event' => 'required|string|max:200',
            'status_event' => 'required|string|max:200',
            'target_participant' => 'required|integer',
            'description' => 'required|string',
        ]);

        $event = $this->eventService->createEvent($data);
        return response()->json(['message' => 'Event created successfully', 'event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:100',
            'type_event' => 'sometimes|string|max:200',
            'status_event' => 'sometimes|string|max:200',
            'target_participant' => 'sometimes|integer',
            'description' => 'sometimes|string',
        ]);

        $event = $this->eventService->updateEvent($id, $data);
        return response()->json(['message' => 'Event updated successfully', 'event' => $event]);
    }

    public function destroy($id)
    {
        $this->eventService->deleteEvent($id);
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
