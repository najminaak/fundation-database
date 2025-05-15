<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'events_id', 'event_category_names_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id', 'id');
    }
    
    public function eventCategoryName()
    {
        return $this->belongsTo(EventCategoryName::class);
    }
}
