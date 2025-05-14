<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontraprestasi extends Model
{
    protected $fillable = ['events_id', 'icon_photo_kontraprestasis_id', 'kontraprestasi_tier_id'];

    public function tier()
    {
        return $this->belongsTo(KontraprestasiTier::class, 'kontraprestasi_tier_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function iconPhotoKontraprestasi()
    {
        return $this->belongsTo(IconPhotoKontraprestasi::class, 'icon_photo_kontraprestasis_id');
    }
}
