<?php

namespace App\Service\Event;

use App\Repository\Event\EventPhotoRepository;
use App\Service\Event\EventPhotoService;
use Illuminate\Support\Facades\Storage;

class EventPhotoServiceImpl implements EventPhotoService
{
    protected $repository;

    public function __construct(EventPhotoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function create($data)
    {
        if (isset($data['photo_file'])) {
            $data['photo_file'] = $this->handleBase64Upload($data['photo_file']);
        }
        \Log::info('Creating EventPhoto', $data);
        return $this->repository->create($data);
    }

    public function update($id, $data)
    {
        if (isset($data['photo_file'])) {
            $data['photo_file'] = $this->handleBase64Upload($data['photo_file']);
        }

        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    private function handleBase64Upload($base64Image)
    {
        if (str_contains($base64Image, 'base64,')) {
            $base64Image = explode('base64,', $base64Image)[1];
        }

        $imageData = base64_decode($base64Image);
        $filename = 'event/photos/' . uniqid() . '.jpg';

        Storage::disk('public')->put($filename, $imageData);

        return 'storage/' . $filename;
    }
}
