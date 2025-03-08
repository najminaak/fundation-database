<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategoryName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'icon', 'parent_id'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_categories');
    }
}
