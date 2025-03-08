<?php
namespace App\Repository\Category;

use App\Models\EventCategory;

class EventCategoryRepository
{
    public function all()
    {
        return EventCategory::all();
    }

    public function find($id)
    {
        return EventCategory::findOrFail($id);
    }

    public function create(array $data)
    {
        return EventCategory::create($data);
    }

    public function delete($id)
    {
        return EventCategory::destroy($id);
    }
}
