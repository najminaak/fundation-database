<?php
namespace App\Service;

use App\Repository\Category\EventCategoryNameRepository;

class EventCategoryNameService
{
    protected $repository;

    public function __construct(EventCategoryNameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCategories()
    {
        return $this->repository->all();
    }

    public function getCategoryById($id)
    {
        return $this->repository->find($id);
    }

    public function createCategory(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCategory($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->repository->delete($id);
    }
}
