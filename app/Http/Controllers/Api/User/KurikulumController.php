<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KurikulumController extends Controller
{
    public function getKurikulum(Request $request)
    {
        if ($request->ajax()) {
            $kurr = Kurikulum::select('title', 'file_kurikulum', 'created_at', 'publish_at')->where('status', 1)->latest()->get();
            return DataTables::of($kurr)->make(true);
        }
    }
}
