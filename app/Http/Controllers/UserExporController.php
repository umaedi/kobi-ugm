<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserExporController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new UserExport($request->year), 'anggota.xlsx');
    }
}
