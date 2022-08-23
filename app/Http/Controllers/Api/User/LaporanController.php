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
            $laporan = Laporan::all();
            return DataTables::of($laporan)->make(true);
        }
    }
}
