<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidCurriculum extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'department',
        'univ',
        'photo',
        'status',
        'year_start',
        'year_end',
        'status',
    ];
}
