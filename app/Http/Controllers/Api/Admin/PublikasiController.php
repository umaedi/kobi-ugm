<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PublikasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $publikasi = Publikasi::select('id', 'nama_dokumen', 'file_dokumen', 'publish_at')->latest()->get();
            return DataTables::of($publikasi)->make(true);
        }
    }
}
