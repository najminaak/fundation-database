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
        // Log ID yang diterima untuk debugging
        \Log::info('Event ID received: ' . $id);
        
        // Konversi ke integer sebelum diproses
        $id = (int) $id;
        
        $event = $this->eventService->getEventById($id);
        
        if (!$event) {
            // Jika event tidak ditemukan, kembalikan response 404 dengan pesan yang lebih jelas
            return response()->json(['message' => 'Event not found'], 404);
        }
        
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
    public function getByCategory($categoryId)
    {
    $events = Event::with([
        'organizer.organization',
        'eventPhotos',
        'categories',
        'eventFund',
        'eventPlacement',
        'kontraprestasis',
        'sponsors',
        'participantCategories',
    
    ])
    ->whereHas('categories', function ($query) use ($categoryId) {
        $query->where('event_category_names.id', $categoryId);
    })
    ->get();

    return response()->json($events);
    }
    public function getPopularEvents()
    {
        \Log::info('Fetching popular events');
        $events = Event::with([
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
        ])
        ->orderBy('click_count', 'desc')
        ->take(10)
        ->get();
    
        return response()->json($events);
    }
    
    public function incrementClick($id)
    {
    $event = Event::findOrFail($id);
    $event->increment('click_count');
    return response()->json([
        'message' => 'Click count updated',
        'click_count' => $event->click_count
    ]);
    }


}
