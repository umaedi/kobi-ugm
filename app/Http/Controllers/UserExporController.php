<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class UserExporController extends Controller
{
    public function export()
    {
        return Excel::download(new UserExport, 'anggota.xlsx');
    }
}
