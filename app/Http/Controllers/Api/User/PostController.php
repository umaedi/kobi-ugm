<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{

    public function index()
    {
        $post = Post::with('category')->latest()->limit(3)->get();
        $result['posts'] = $post;
        return $this->sendResponseOk($result);
    }

    public function newsOrArticle()
    {
        $post = Post::with('category')->latest()->limit(6)->get();
        $result['posts'] = $post;
        return $this->sendResponseOk($result);
    }

    public function postList(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::with('category')->latest()->get();
            return DataTables::of($posts)->make(true);
        }
    }

    public function lastPost()
    {
        $lastpost = Post::latest()->limit(4)->get();
        $result['lastpost'] = $lastpost;
        return $this->sendResponseOk($result);
    }
}
