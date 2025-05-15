<?php

namespace App\Service\Event;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventFund;
use App\Models\EventPhoto;
use App\Models\EventPlacement;
use App\Models\Kontraprestasi;
use App\Models\Organizer;
use App\Models\ParticipantCategory;
use App\Models\Sponsor;
use App\Repository\Event\EventRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventServiceImpl implements EventService
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

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
        ])->find($id);
    }

    public function createEvent(array $data)
    {
        return DB::transaction(function () use ($data) {
            $organizer = Organizer::where('user_id', Auth::id())->first();

            if (!$organizer) {
                throw new \Exception('Organizer not found for the logged-in user.');
            }

            // Create Event
            $event = Event::create([
                'title' => $data['event']['title'],
                'description' => $data['event']['description'] ?? null,
                'type_event' => $data['event']['type_event'] ?? null,
                'status_event' => $data['event']['status_event'] ?? null,
                'target_participant' => $data['event']['target_participant'] ?? 0,
                'organizers_id' => $organizer->id,
            ]);

            // Save Event Photos
            foreach ($data['event_photos'] ?? [] as $photo) {
                EventPhoto::create([
                    'events_id' => $event->id,
                    'photo_file' => $photo['photo_file'],
                ]);
            }

            // Save Event Categories
            foreach ($data['event_categories'] ?? [] as $category) {
                EventCategory::create([
                    'events_id' => $event->id,
                    'event_category_names_id' => $category['event_category_names_id'],
                ]);
            }

            // Save Event Fund
            if (isset($data['event_fund'])) {
                EventFund::create([
                    'events_id' => $event->id,
                    'target_fund' => $data['event_fund']['target_fund'],
                    'sponsor_deadline' => $data['event_fund']['sponsor_deadline'],
                ]);
            }

            // Save Event Placement
            if (isset($data['event_placement'])) {
                EventPlacement::create([
                    'events_id' => $event->id,
                    'event_start_date' => $data['event_placement']['event_start_date'],
                    'event_end_date' => $data['event_placement']['event_end_date'],
                    'event_venue' => $data['event_placement']['event_venue'],
                    'address' => $data['event_placement']['address'],
                    'city' => $data['event_placement']['city'],
                    'province' => $data['event_placement']['province'],
                ]);
            }

            // Save Kontraprestasi
            foreach ($data['kontraprestasi'] ?? [] as $kontra) {
                Kontraprestasi::create([
                    'events_id' => $event->id,
                    'icon_photo_kontraprestasis_id' => $kontra['icon_photo_kontraprestasi_id'],
                    'title' => $kontra['title'],
                    'min_sponsor' => $kontra['min_sponsor'],
                    'max_sponsor' => $kontra['max_sponsor'],
                    'feedback' => $kontra['feedback'],
                ]);
            }

            // Save Sponsors
            foreach ($data['sponsors'] ?? [] as $sponsor) {
                Sponsor::create([
                    'event_id' => $event->id,
                    'amount' => $sponsor['amount'],
                    'entrepreneur_id' => $sponsor['entrepreneur_id'],
                ]);
            }

            // Save Participant Categories
            foreach ($data['participant_categories'] ?? [] as $participantCategory) {
                ParticipantCategory::create([
                    'events_id' => $event->id,
                    'participant_name' => $participantCategory['name'],
                ]);
            }

            return $event;
        });
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
