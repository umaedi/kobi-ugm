<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserExporController extends Controller
{
    public function export()
    {
        return Excel::download(new UserExport, 'anggota.xlsx');
    }
}
