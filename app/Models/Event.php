<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d F Y');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
