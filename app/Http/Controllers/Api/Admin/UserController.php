<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Api as Controller;
use App\Models\Universitas;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Universitas::where('status', 0)->latest()->get();
            return DataTables::of($users)->make(true);
        }
    }

    public function anggotaLama(Request $request)
    {
        if ($request->ajax()) {
            $users = Universitas::where('status', 4)->latest()->get();
            return DataTables::of($users)->make(true);
        }
    }

    public function userActive(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tahun) {
                $data     = Universitas::where('thn_anggota', $request->tahun)->where('status', $request->status)->get();
                return DataTables::of($data)->make();
            }

            $users = Universitas::where('thn_anggota', $request->tahun)->where('status', $request->status)->latest()->get();
            return DataTables::of($users)->make(true);
        }
    }

    public function userReject(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tahun) {
                $users = Universitas::where('thn_anggota', $request->tahun)->where('status', $request->status)->latest()->get();
                return DataTables::of($users)->make(true);
            }
            $users = Universitas::where('status', $request->status)->latest()->get();
            return DataTables::of($users)->make(true);
        }
    }

    public function nonAktif(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tahun) {
                $data     = Universitas::where('thn_anggota', $request->tahun)->where('status', $request->status)->get();
                return DataTables::of($data)->make();
            }

            $users = Universitas::where('status', $request->status)->latest()->get();
            return DataTables::of($users)->make(true);
        }
    }
}
