<?php
namespace App\Service\Category;

use App\Repository\Category\EventCategoryRepository;

class EventCategoryService
{
    protected $repository;

    public function __construct(EventCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllEventCategories()
    {
        return $this->repository->all();
    }

    public function getEventCategoryById($id)
    {
        return $this->repository->find($id);
    }

    public function createEventCategory(array $data)
    {
        return $this->repository->create($data);
    }

    public function deleteEventCategory($id)
    {
        return $this->repository->delete($id);
    }
}
