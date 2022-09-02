<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structur extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position', 'univ', 'photo', 'status', 'year_start', 'year_end'];
}
