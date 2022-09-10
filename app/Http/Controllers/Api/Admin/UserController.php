<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
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

    public function userActive(Request $request)
    {
        if ($request->ajax()) {
            $users = Universitas::where('status', 1)->latest()->get();
            return DataTables::of($users)->make(true);
        }
    }
}
