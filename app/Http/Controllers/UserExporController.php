<?php

namespace App\Http\Controllers;

use App\Exports\StrExport;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserExporController extends Controller
{
    public function exportUser(Request $request)
    {
        return Excel::download(new UserExport($request->year), 'Data anggota aktif tahun ' . $request->year . '.xlsx');
    }

    public function dataStr(Request $request)
    {
        return Excel::download(new StrExport($request->status), 'Data STR.xlsx');
    }
}
