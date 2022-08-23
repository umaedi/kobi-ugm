<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publikasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['publish_at'])
            ->translatedFormat('d/m/Y');
    }
}
