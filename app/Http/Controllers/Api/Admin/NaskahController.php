<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Naskah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class NaskahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $publikasi = Naskah::select('id', 'nama_dokumen', 'file_dokumen', 'publish_at')->latest()->get();
            return DataTables::of($publikasi)->make(true);
        }
    }
}
