<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'department_id',
        'univ',
        'photo',
        'status',
        'year_start',
        'year_end'
    ];
}
