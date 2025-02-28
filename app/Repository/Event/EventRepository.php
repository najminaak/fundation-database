<?php

namespace App\Repository\Event;

use App\Models\Event;

interface EventRepository
{
    public function getAllEvents();
    public function getEventById(int $id);
    public function createEvent(array $data);
    public function updateEvent(int $id, array $data);
    public function deleteEvent(int $id);
}