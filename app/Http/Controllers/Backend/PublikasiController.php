<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PublikasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $publikasi = Publikasi::latest()->get();
            return DataTables::of($publikasi)->make(true);
        }
    }
}
