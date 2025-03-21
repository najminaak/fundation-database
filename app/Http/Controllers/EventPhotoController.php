<?php

namespace App\Http\Controllers;

use App\Models\EventPhoto;
use App\Services\EventPhotoService;
use Illuminate\Http\Request;

class EventPhotoController extends Controller
{
    protected $service;

    public function __construct(EventPhotoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show(EventPhoto $eventPhoto) // Path binding digunakan di sini
    {
        return response()->json($eventPhoto);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'photo_file' => 'required|string'
        ]);

        return response()->json($this->service->create($data));
    }

    public function update(Request $request, EventPhoto $eventPhoto) // Path binding digunakan di sini
    {
        $data = $request->validate(['photo_file' => 'sometimes|string']);
        return response()->json($this->service->update($eventPhoto->id, $data));
    }

    public function destroy(EventPhoto $eventPhoto) // Path binding digunakan di sini
    {
        return response()->json($this->service->delete($eventPhoto->id));
    }
}
