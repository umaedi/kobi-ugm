<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Facades\Storage;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kurikulum = Kurikulum::latest()->get();
            return DataTables::of($kurikulum)->make(true);
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
            'body'          => 'required',
            'image'         => 'image|file|max:4096',
            'status'        => 'required',
            'publish_at'    => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $thumb = $request->file('image');
        $thumb->storeAs('public/thumb', $thumb->hashName());

        $post = Kurikulum::create([
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
        $dokKurikulum = Kurikulum::findOrfail($id);
        $validator = Validator::make($request->all(), [
            'title'         => 'required|unique:posts,title,' . $dokKurikulum->id,
            'body'          => 'required',
            'image'         => 'image|file|max:4096',
            'status'        => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('image') == '') {
            $dokKurikulum->update([
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'body'          => $request->body,
                'image'         => $dokKurikulum->image,
                'publish_at'    => $request->publish_at ? $request->publish_at : $dokKurikulum->publish_at,
                'status'        => $request->status
            ]);
            return $this->sendResponseUpdate($dokKurikulum);
        } else {
            Storage::disk('local')->delete('public/thumb/' . basename($dokKurikulum->image));
            $thumb = $request->file('image');
            $thumb->storeAs('public/thumb', $thumb->hashName());

            $dokKurikulum->update([
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'body'          => $request->body,
                'image'         => $thumb->hashName(),
                'publish_at'    => $request->publish_at ? $request->publish_at : $dokKurikulum->publish_at,
                'status'        => $request->status
            ]);
            return $this->sendResponseUpdate($dokKurikulum);
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
        $dokKurikulum = Kurikulum::findOrfail($id);
        Storage::disk('local')->delete('public/thumb/' . basename($dokKurikulum->file_dokumen));
        $dokKurikulum->destroy($id);
        return $this->sendResponseDelete($dokKurikulum);
    }
}
