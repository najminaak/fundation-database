<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        \Log::info('Event ID received: ' . $id);
        $id = (int) $id;

        $event = $this->eventService->getEventById($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json($event);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event.title' => 'required|string|max:100',
            'event.description' => 'nullable|string',
            'event.type_event' => 'nullable|string|max:200',
            'event.status_event' => 'nullable|string|max:200',
            'event.target_participant' => 'nullable|integer',
            
            'event_photos' => 'nullable|array',
            'event_photos.*.photo_file' => 'required|string',
            
            'event_categories' => 'nullable|array',
            'event_categories.*.event_category_names_id' => 'required|integer|exists:event_category_names,id',
            
            'event_fund.target_fund' => 'nullable|numeric',
            'event_fund.sponsor_deadline' => 'nullable|date',
            
            'event_placement.event_start_date' => 'nullable|date',
            'event_placement.event_end_date' => 'nullable|date',
            'event_placement.event_venue' => 'nullable|string',
            'event_placement.address' => 'nullable|string',
            'event_placement.city' => 'nullable|string',
            'event_placement.province' => 'nullable|string',
            
            'kontraprestasi' => 'nullable|array',
            'kontraprestasi.*.icon_photo_kontraprestasi_id' => 'required|integer',
            'kontraprestasi.*.title' => 'required|string',
            'kontraprestasi.*.min_sponsor' => 'required|integer',
            'kontraprestasi.*.max_sponsor' => 'required|integer',
            'kontraprestasi.*.feedback' => 'required|string',
            
            'sponsors' => 'nullable|array',
            'sponsors.*.amount' => 'required|numeric',
            'sponsors.*.entrepreneur_id' => 'required|integer',
            
            'participant_categories' => 'nullable|array',
            'participant_categories.*.name' => 'required|string',
        ]);

        $event = $this->eventService->createEvent($validated);

        return response()->json(['message' => 'Event created successfully', 'event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $id = (int) $id;
        $data = $request->validate([
            'title' => 'sometimes|string|max:100',
            'type_event' => 'sometimes|string|max:200',
            'status_event' => 'sometimes|string|max:200',
            'target_participant' => 'sometimes|integer',
            'description' => 'sometimes|string',
        ]);

        $event = $this->eventService->updateEvent($id, $data);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json(['message' => 'Event updated successfully', 'event' => $event]);
    }

    public function destroy($id)
    {
        $id = (int) $id;
        try {
            $this->eventService->deleteEvent($id);
            return response()->json(['message' => 'Event deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found'], 404);
        }
    }

    public function getByCategory($categoryId)
    {
        $events = $this->eventService->getByCategory((int)$categoryId);
        return response()->json($events);
    }
}
