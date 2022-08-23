<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FrontendController extends Controller
{
    public function laporan(Request $request)
    {
        if ($request->ajax()) {
            $laporan = Laporan::all();
            return DataTables::of($laporan)->make(true);
        }
    }
}
