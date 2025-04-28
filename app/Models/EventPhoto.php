<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'events_id', 'photo_file'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id', 'id');
    }
}
