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
            'file_kurikulum'          => 'required',
            'status'        => 'required',
            'publish_at'    => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('file_kurikulum')) {
            $file = $request->file('file_kurikulum');
            $file->storeAs('public/kurik', $file->hashName());
        }

        $post = Kurikulum::create([
            'title'         => $request->title,
            'file_kurikulum'    => $file->hashName(),
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
            'title'         => 'required|unique:kurikulums,title,' . $dokKurikulum->id,
            'status'        => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('file_kurikulum') == '') {
            $dokKurikulum->update([
                'title'         => $request->title,
                'file_kurikulum' => $dokKurikulum->file_kurikulum,
                'publish_at'    => $request->publish_at ? $request->publish_at : $dokKurikulum->publish_at,
                'status'        => $request->status
            ]);
            return $this->sendResponseUpdate($dokKurikulum);
        } else {
            Storage::disk('local')->delete('public/kurik/' . basename($dokKurikulum->image));
            $fileKurikulum = $request->file('file_kurikulum');
            $fileKurikulum->storeAs('public/kurik', $fileKurikulum->hashName());

            $dokKurikulum->update([
                'title'         => $request->title,
                'file_kurikulum' => $fileKurikulum->hashName(),
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
        Storage::disk('local')->delete('public/kurik/' . basename($dokKurikulum->file_dokumen));
        $dokKurikulum->destroy($id);
        return $this->sendResponseDelete($dokKurikulum);
    }
}
