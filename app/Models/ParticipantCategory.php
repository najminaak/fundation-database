<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantCategory extends Model
{
    use HasFactory;

    protected $fillable = ['events_id', 'participant_name'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id', 'id');
    }
}
