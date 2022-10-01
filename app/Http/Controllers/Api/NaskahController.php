<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Naskah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;

class NaskahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $publikasi = Naskah::latest()->get();
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
            'nama_dokumen'  => 'required|unique:naskahs',
            'file_dokumen'  => 'required|mimes:pdf,docx|max:2048',
            'publish_at'    => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('file_dokumen')) {
            $file_dokumen = $request->file('file_dokumen');
            $file_dokumen->storeAs('public/09663cfd', $file_dokumen->hashName());
        }

        $publikasi = Naskah::create([
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
    public function update(Request $request, Naskah $naskah)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen'  => 'required|unique:naskahs,nama_dokumen,' . $naskah->id,
            'file_dokumen'  => 'file|mimes:pdf,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('file_dokumen') == '') {
            $naskah = Naskah::where('id', $naskah->id)->update([
                'nama_dokumen'  => $request->nama_dokumen,
                'slug'          => Str::slug($request->nama_dokumen),
                'file_dokumen'  => $naskah->file_dokumen,
                'publish_at'    => $request->publish_at ? $request->publish_at  : $naskah->publish_at
            ]);
            return $this->sendResponseUpdate($naskah);
        } else {
            Storage::disk('local')->delete('public/09663cfd/' . basename($naskah->file_dokumen));
            $file_dokumen = $request->file('file_dokumen');
            $file_dokumen->storeAs('public/09663cfd', $file_dokumen->hashName());

            $naskah = Naskah::where('id', $naskah->id)->update([
                'nama_dokumen'  => $request->nama_dokumen,
                'slug'          => Str::slug($request->nama_dokumen),
                'file_dokumen'  => $file_dokumen->hashName(),
                'publish_at'    => $request->publish_at ? $request->publish_at : $naskah->publish_at
            ]);
            return $this->sendResponseUpdate($naskah);
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
        $naskah = Naskah::findOrfail($id);
        if ($naskah->file_dokumen) {
            Storage::disk('local')->delete('public/09663cfd/' . basename($naskah->file_dokumen));
        }
        $naskah->destroy($id);
        return $this->sendResponseOk($naskah);
    }
}
