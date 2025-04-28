<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizers_id', 'title', 'description','target_participant', 'participant_description', 'status_event', 'type_event'
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizers_id', 'id');
    }

    public function eventPhotos()
    {
        return $this->hasMany(EventPhoto::class, 'events_id', 'id');
    }

    public function eventCategories(){
        return $this->hasMany(EventCategory::class, 'events_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(EventCategoryName::class, 'event_categories','events_id','event_category_names_id');
    }

    public function eventFund(){
        return $this->hasOne(EventFund::class, 'events_id', 'id');
    }

    public function eventPlacement(){
        return $this->hasOne(EventPlacement::class, 'events_id', 'id');
    }

    public function kontraprestasis(){
        return $this->hasMany(Kontraprestasi::class, 'events_id', 'id');
    }

    public function sponsors(){
        return $this->hasMany(Sponsor::class, 'event_id', 'id');
    }

    public function participantCategories(){
        return $this->hasMany(ParticipantCategory::class, 'events_id', 'id');
    }

}
