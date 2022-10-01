<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Naskah;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    public function publication(Request $request)
    {
        if ($request->ajax()) {
            $publication = Publikasi::select('nama_dokumen', 'publish_at', 'file_dokumen')->latest()->get();
            return DataTables::of($publication)->make(true);
        }
    }

    public function script(Request $request)
    {
        if ($request->ajax()) {
            $publication = Naskah::select('nama_dokumen', 'publish_at', 'file_dokumen')->latest()->get();
            return DataTables::of($publication)->make(true);
        }
    }
}
