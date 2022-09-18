<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;
use Yajra\DataTables\Facades\DataTables;

class UnivController extends Controller
{
    public function users(Request $request)
    {
        $data = Universitas::where('thn_anggota', $request->tahun)->limit($request->lengt)->get();

        if ($request->search != '') {
            $data = Universitas::where('no_anggota', $request->search)->get();
        }
        return DataTables::of($data)->make();
    }
}
