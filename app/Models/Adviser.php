<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'departmen_id',
        'position',
        'univ',
        'photo',
        'status',
        'year_start',
        'year_end'
    ];
}
