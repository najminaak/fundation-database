<?php

namespace App\Repository\Event;

use App\Models\EventFund;

class EventFundRepositoryImpl implements EventFundRepository{
    public function getAll()
    {
        return EventFundPhoto::all();
    }

    public function getById($id)
    {
        return EventFund::findOrFail($id);
    }

    public function create($data)
    {
        return EventFund::create($data);
    }

    public function update($id, $data)
    {
        $photo = EventFund::findOrFail($id);
        $photo->update($data);
        return $photo;
    }

    public function delete($id)
    {
        return EventFund::destroy($id);
    }
}