<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class ImageController extends Controller
{
    public function store()
    {
        // $task = new Task();
        // $task->id = 0;
        // $task->exists = true;
        // $image = $task->addMediaFromRequest('upload')->toMediaCollection('images');

        $post = new Post();
        $post->id = 0;
        $post->exists = true;
        $image = $post->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url' => $image->getUrl('thumb')
        ]);
    }
}
