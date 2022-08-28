<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api as Controller;
use App\Models\Founder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FounderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $founder = Founder::latest()->get();
        $result['founder'] = $founder;
        return $this->sendResponseOk($result);
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
            'name'  => 'required|max:255',
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $photo->storeAs('public/founder', $photo->hashName());
        }

        $fo = Founder::create([
            'name'  => $request->name,
            'position' => $request->position,
            'photo' => $photo->hashName()
        ]);
        return $this->sendResponseCreate($fo);
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
        $founder = Founder::findOrfail($id);
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:255',
            'position' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('photo') == '') {
            $fo = $founder->update([
                'name'  => $request->name,
                'position' => $request->position,
                'photo' => $founder->photo
            ]);
            return $this->sendResponseUpdate($fo);
        } else {
            Storage::disk('local')->delete('public/founder', basename($founder->photo));
            $photo = $request->file('photo');
            $photo->storeAs('public/founder', $photo->hashName());

            $fo = $founder->update([
                'name'  => $request->name,
                'position' => $request->position,
                'photo' => $photo->hashName()
            ]);
            return $this->sendResponseUpdate($fo);
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
        $fo = Founder::findOrfail($id);
        if ($fo->photo) {
            Storage::disk('local')->delete('public/founder' . basename($fo->photo));
        }
        $fo->destroy($id);
        return $this->sendResponseDelete($fo);
    }
}
