<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function laporan(Request $request)
    {
        if ($request->ajax()) {
            $laporan = Laporan::select('nama_kegiatan', 'created_at', 'file_laporan')->latest()->get();
            return DataTables::of($laporan)->make(true);
        }
    }
}
