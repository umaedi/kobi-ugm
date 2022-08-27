<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api as Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $phtos = Gallery::latest()
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
            'title' => 'required',
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:3072'
        ]);

        if ($validator->fails()) {
            return  $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $photo->storeAs('public/galeri', $photo->hashName());
        }

        $savePhoto = Gallery::create([
            'title' => $request->title,
            'photo' => $photo->hashName()
        ]);

        if ($savePhoto) {
            return $this->sendResponseCreate($savePhoto);
        }
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
        $dataPhoto = Gallery::findOrfail($id)->first();
        $validator = Validator::make($request->only('title'), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('photo') == '') {
            $dataPhoto->update([
                'title' => $request->title,
                'photo' => $dataPhoto->photo
            ]);
            return $this->sendResponseUpdate($dataPhoto);
        }

        if ($request->file('photo') == true) {
            Storage::disk('local')->delete('public/galeri/' . basename($dataPhoto->photo));
            $newPhoto = $request->file('photo');
            $newPhoto->storeAs('public/galeri', $newPhoto->hashName());

            $dataPhoto->update([
                'title' => $request->title,
                'photo' => $newPhoto->hashName()
            ]);
            return $this->sendResponseUpdate($dataPhoto);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Gallery::findOrfail($id);
        if ($photo->photo) {
            Storage::disk('local')->delete('public/galeri/' . basename($photo->photo));
        }
        $photo->destroy($id);
        return $this->sendResponseDelete($photo);
    }
}
