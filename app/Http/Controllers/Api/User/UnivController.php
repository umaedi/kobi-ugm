<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UnivController extends Controller
{
    public function users(Request $request)
    {
        $data = Universitas::where('status', 1)->get();

        if ($request->tahun) {
            $data     = Universitas::where('thn_anggota', $request->tahun)->where('status', 1)->get();
        }
        return DataTables::of($data)->make();
    }
}
