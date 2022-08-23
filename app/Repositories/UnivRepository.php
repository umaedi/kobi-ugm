<?php

namespace App\Repositories;

use App\Models\Post;
use Yajra\DataTables\Facades\DataTables;

class PostRepository
{
    public function getAll()
    {
        $posts = Post::with('category')->latest()->get();
        return DataTables::of($posts)->make(true);
    }
}
