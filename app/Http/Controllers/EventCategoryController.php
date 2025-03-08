<?php

namespace App\Http\Controllers;

use App\Service\Category\EventCategoryService;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;

    public function __construct(EventCategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAllEventCategories());
    }

    public function show($id)
    {
        return response()->json($this->service->getEventCategoryById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|integer',
            'event_category_name_id' => 'required|exists:event_category_names,id',
        ]);

        return response()->json($this->service->createEventCategory($data), 201);
    }

    public function destroy($id)
    {
        return response()->json($this->service->deleteEventCategory($id));
    }
}
