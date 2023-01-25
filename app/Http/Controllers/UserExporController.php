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
        if ($request->year) {
            $year = $request->year;
        } else {
            $year = "";
        }
        return Excel::download(new UserExport($year, $request->status), 'Data Anggota KOBI' . '.xlsx');
    }

    public function dataStr(Request $request)
    {
        return Excel::download(new StrExport($request->status), 'Data STR.xlsx');
    }
}
