<?php

namespace App\Http\Controllers;

use App\Service\EventCategoryNameService;
use Illuminate\Http\Request;

class EventCategoryNameController extends Controller
{
    protected $service;

    public function __construct(EventCategoryNameService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAllCategories());
    }

    public function show($id)
    {
        return response()->json($this->service->getCategoryById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'parent_id' => 'nullable|exists:event_category_names,id',
            'icon' => 'required|string|max:20',
        ]);

        return response()->json($this->service->createCategory($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:50',
            'parent_id' => 'nullable|exists:event_category_names,id',
            'icon' => 'sometimes|string|max:20',
        ]);

        return response()->json($this->service->updateCategory($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->service->deleteCategory($id));
    }
}
