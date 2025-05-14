<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontraprestasiTier extends Model
{
    protected $fillable = ['title', 'min_sponsor', 'max_sponsor'];

    public function kontraprestasis()
    {
        return $this->hasMany(Kontraprestasi::class);
    }
}

