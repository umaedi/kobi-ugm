<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurikulum extends Model
{
    use HasFactory;
    protected $fillable = ['nama_dokumen', 'file_dokumen', 'publish_at'];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d F Y');
    }
}
