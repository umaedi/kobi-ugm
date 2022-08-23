<?php

namespace App\Http\Controllers\Api;

use App\Models\Publikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PublikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $publikasi = Publikasi::latest()->get();
            return DataTables::of($publikasi)->make(true);
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
            'nama_dokumen'  => 'required|unique:publikasis',
            'file_dokumen'  => 'required|mimes:pdf,docx|max:2048',
            'publish_at'    => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $file_dokumen = $request->file('file_dokumen');
        $file_dokumen->storeAs('public/publikasi', $file_dokumen->hashName());

        $publikasi = Publikasi::create([
            'nama_dokumen'  => $request->nama_dokumen,
            'slug'          => Str::slug($request->nama_dokumen),
            'file_dokumen'  => $file_dokumen->hashName(),
            'publish_at'    => $request->publish_at
        ]);
        return $this->sendResponseCreate($publikasi);
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
    public function update(Request $request, Publikasi $publikasi)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen'  => 'required|unique:publikasis,nama_dokumen,' . $publikasi->id,
            'file_dokumen'  => 'file|mimes:pdf,docx|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('file_dokumen') == '') {
            $publikasi = Publikasi::where('id', $publikasi->id)->update([
                'nama_dokumen'  => $request->nama_dokumen,
                'slug'          => Str::slug($request->nama_dokumen),
                'file_dokumen'  => $publikasi->file_dokumen,
                'publish_at'    => $request->publish_at ? $request->publish_at : $publikasi->publish_at
            ]);
            return $this->sendResponseUpdate($publikasi);
        } else {
            Storage::disk('local')->delete('public/publikasi/' . basename($publikasi->file_dokumen));
            $file_dokumen = $request->file('file_dokumen');
            $file_dokumen->storeAs('public/publikasi', $file_dokumen->hashName());
            $publikasi = Publikasi::where('id', $publikasi->id)->update([
                'nama_dokumen'  => $request->nama_dokumen,
                'slug'          => Str::slug($request->nama_dokumen),
                'file_dokumen'  => $file_dokumen->hashName(),
                'publish_at'    => $request->publish_at ? $request->publish_at : $publikasi->publish_at
            ]);
            return $this->sendResponseUpdate($publikasi);
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
        $publikasi = Publikasi::findOrfail($id);
        if ($publikasi->file_dokumen) {
            Storage::disk('local')->delete('public/publikasi/' . basename($publikasi->file_dokumen));
        }
        $publikasi->destroy($id);
        return $this->sendResponseOk($publikasi);
    }
}
