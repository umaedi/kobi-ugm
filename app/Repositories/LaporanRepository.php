<?php

namespace App\Repositories;

use App\Models\Laporan;
use Yajra\DataTables\Facades\DataTables;

class LaporanRepository
{
    public function getAll()
    {
        $report = Laporan::all();
        return DataTables::of($report)->make(true);
    }
}
