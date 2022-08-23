<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepository $postRepositity)
    {
        $this->postRepository = $postRepositity;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = $this->postRepository->getAll();
            return $posts;
        }
    }

    public function getByStatus(Request $request, $status)
    {
        if ($request->ajax()) {
            $posts = $this->postRepository->getByStatus($status);
            return $posts;
        }
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'category_id'   => 'required',
            'body'          => 'required',
            'image'         => 'image|file|max:1024',
            'status'        => 'required',
            'publish_at'    => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $thumb = $request->file('image');
        $thumb->storeAs('public/thumb', $thumb->hashName());

        $post = Post::create([
            'category_id'   => $request->category_id,
            'user_id'       => $request->user_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'body'          => $request->body,
            'image'         => $thumb->hashName(),
            'publish_at'    => $request->publish_at,
            'status'        => $request->status
        ]);

        return $this->sendResponseCreate($post);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|unique:posts,title,' . $post->id,
            'category_id'   => 'required',
            'body'          => 'required',
            'image'         => 'image|file|max:1024',
            'status'        => 'required',
            'publish_at'    => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('image') == '') {
            $post = Post::where('id', $post->id)->update([
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'category_id'   => $request->category_id,
                'body'          => $request->body,
                'image'         => $post->image,
                'publish_at'    => $request->publish_at,
                'status'        => $request->status
            ]);
            return $this->sendResponseUpdate($post);
        } else {
            Storage::disk('local')->delete('public/thumb/' . basename($post->image));
            $thumb = $request->file('image');
            $thumb->storeAs('public/thumb', $thumb->hashName());

            $post = Post::where('id', $post->id)->update([
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'category_id'   => $request->category_id,
                'body'          => $request->body,
                'image'         => $thumb->hashName(),
                'publish_at'    => $request->publish_at,
                'status'        => $request->status
            ]);
            return $this->sendResponseUpdate($post);
        }

        if ($request->file('image')) {
            Storage::disk('local')->delete('public/thumb/' . $post->image);
        } else {
            $thumb = $request->file('image');
            $thumb->storeAs('public/thumb', $thumb->hashName());
            $post->update([
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'category_id'   => $request->category_id,
                'body'          => $request->body,
                'image'         => $thumb->hashName(),
                'publish_at'    => Carbon::now(),
                'status'        => $request->status
            ]);
        }

        $result['post'] = $post;
        return $this->sendResponseCreate($request);
    }

    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        if ($post->image) {
            Storage::disk('local')->delete('public/thumb/' . $post->iamge);
        }
        $post->destroy($post->id);
        return $this->sendResponseDelete($post);
    }
}
