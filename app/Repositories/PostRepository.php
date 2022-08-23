<?php

namespace App\Repositories;

use App\Models\Post;
use Yajra\DataTables\Facades\DataTables;

class PostRepository
{
    public function getAll()
    {
        $posts = Post::with('category')->where('status', 1)->latest()->get();
        return DataTables::of($posts)->make(true);
    }

    public function getByStatus($status)
    {
        $posts = Post::with('category')->where('status', $status)->latest()->get();
        return DataTables::of($posts)->make(true);
    }
}
