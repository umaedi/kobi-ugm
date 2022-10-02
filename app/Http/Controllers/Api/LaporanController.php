<?php

namespace App\Http\Controllers\Api;

use App\Models\Laporan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporan = Laporan::latest()->get();
            return DataTables::of($laporan)->make(true);
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
            'nama_kegiatan'  => 'required|unique:laporans',
            'file_laporan'  => 'required|mimes:pdf,docx|max:2048',
            'tgl_kegiatan'  => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $file_laporan = $request->file('file_laporan');
        $file_laporan->storeAs('public/reports', $file_laporan->hashName());

        $laporan = Laporan::create([
            'nama_kegiatan'  => $request->nama_kegiatan,
            'slug'          => Str::slug($request->nama_kegiatan),
            'file_laporan'  => $file_laporan->hashName(),
            'tgl_kegiatan'    => $request->tgl_kegiatan,
            'created_at'    => $request->tgl_kegiatan
        ]);
        return $this->sendResponseCreate($laporan);
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
    public function update(Request $request, Laporan $laporan)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan'  => 'required|unique:laporans,nama_kegiatan,' . $laporan->id,
            'file_laporan'  => 'file|mimes:pdf,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('file_laporan') == '') {
            $laporan = Laporan::where('id', $laporan->id)->update([
                'nama_kegiatan'  => $request->nama_kegiatan,
                'slug'          => Str::slug($request->nama_kegiatan),
                'file_laporan'  => $laporan->file_laporan,
                'tgl_kegiatan'  => $request->tgl_kegiatan ? $request->tgl_kegiatan : $laporan->tgl_kegiatan,
                'created_at'  => $request->tgl_kegiatan ? $request->tgl_kegiatan : $laporan->tgl_kegiatan,
            ]);
            return $this->sendResponseUpdate($laporan);
        } else {
            Storage::disk('local')->delete('public/reports/' . basename($laporan->file_dokumen));
            $file_laporan = $request->file('file_laporan');
            $file_laporan->storeAs('public/reports', $file_laporan->hashName());
            $laporan = Laporan::where('id', $laporan->id)->update([
                'nama_kegiatan'  => $request->nama_kegiatan,
                'slug'          => Str::slug($request->nama_kegiatan),
                'file_laporan'  => $file_laporan->hashName(),
                'tgl_kegiatan'  => $request->tgl_kegiatan ? $request->tgl_kegiatan : $laporan->tgl_kegiatan,
                'created_at'  => $request->tgl_kegiatan ? $request->tgl_kegiatan : $laporan->tgl_kegiatan,
            ]);
            return $this->sendResponseUpdate($laporan);
        }
    }
    public function destroy($id)
    {
        $laporan = Laporan::findOrfail($id);
        if ($laporan->file_laporan) {
            Storage::disk('local')->delete('public/reports/' . basename($laporan->file_laporan));
        }
        $laporan->destroy($id);
        return $this->sendResponseDelete($laporan);
    }
}
