<?php

namespace App\Http\Controllers\Api;

use App\Models\AdArt;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdArtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $adArt = AdArt::latest()->get();
            return DataTables::of($adArt)->make(true);
        }
    }

    public function userIndex()
    {
        $adArt = AdArt::latest()->limit(1)->get();
        $result['adart'] = $adArt;
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
        //
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
    public function update(Request $request, AdArt $adArt)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen'  => 'required',
            'file_dokumen'  => 'file|mimes:pdf,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('file_dokumen') == '') {
            $adArt = AdArt::where('id', $adArt->id)->update([
                'nama_dokumen'  => $request->nama_dokumen,
                'slug'          => Str::slug($request->nama_dokumen),
                'file_dokumen'  => $adArt->file_dokumen,
                'publish_at'    => $request->publish_at ? $request->publish_at : $adArt->file_dokumen,
            ]);
            return $this->sendResponseUpdate($adArt);
        } else {
            Storage::disk('local')->delete('public/ad-art/' . basename($adArt->file_dokumen));
            $file_dokumen = $request->file('file_dokumen');
            $file_dokumen->storeAs('public/ad-art', $file_dokumen->hashName());
            $adArt = AdArt::where('id', $adArt->id)->update([
                'nama_dokumen'  => $request->nama_dokumen,
                'slug'          => Str::slug($request->nama_dokumen),
                'file_dokumen'  => $file_dokumen->hashName(),
                'publish_at'    => $request->publish_at ? $request->publish_at : $adArt->file_dokumen,
            ]);
            return $this->sendResponseUpdate($adArt);
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
        // $adart = AdArt::findOrfail();

    }
}
