<?php
namespace App\Repository\Category;

use App\Models\EventCategoryName;

class EventCategoryNameRepository
{
    public function all()
    {
        return EventCategoryName::all();
    }

    public function find($id)
    {
        return EventCategoryName::findOrFail($id);
    }

    public function create(array $data)
    {
        return EventCategoryName::create($data);
    }

    public function update($id, array $data)
    {
        $category = EventCategoryName::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        return EventCategoryName::destroy($id);
    }
}
