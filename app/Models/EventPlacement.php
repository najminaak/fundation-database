<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPlacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'events_id', 'event_start_date', 'event_end_date', 'event_venue', 'address', 'city', 'province'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id', 'id');
    }
}
