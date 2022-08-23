<?php

namespace App\Repositories;

use App\Models\Mastermedia;
use Yajra\DataTables\Facades\DataTables;

class MediaRepository
{
    public function getAll()
    {
        $media = Mastermedia::with('category')->latest()->get();
        return DataTables::of($media)->make(true);
    }
}
