<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $event = Event::with('eventCategory')->latest()->get();
            return DataTables::of($event)->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'event_category_id'      => 'required',
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

        $post = Event::create([
            'event_category_id'      => $request->event_category_id,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrfail($id);
        if ($event->image) {
            Storage::disk('local')->delete('public/thumb/' . basename($event->image));
        }
        $event->destroy($id);
        return $this->sendResponseDelete($event);
    }
}
