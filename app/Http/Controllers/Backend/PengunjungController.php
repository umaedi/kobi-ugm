<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Pengunjung;
use App\Http\Controllers\Controller;

class PengunjungController extends Controller
{
    public function index()
    {

        $dateNow    = Carbon::now()->format('Y-m-d');
        $yesterDay  = Carbon::yesterday()->format('Y-m-d');
        $endWeek    = Carbon::now()->endOfWeek();
        $monthNow   = Carbon::now()->format('m');
        $startWeek  = Carbon::now()->startOfWeek();


        if (\request()->ajax()) {

            $visitor = Pengunjung::query();
            $data['table'] = $visitor->orderBy('total_pengunjung', 'DESC')->paginate(10);
            $data['total_pengunjung'] = $visitor->sum('total_pengunjung');
            return view('backend.pengunjung._data_table', $data);
        }

        $hari_ini = Pengunjung::whereDate('updated_at', $dateNow)->sum($monthNow);
        $kemaren = Pengunjung::whereDate('updated_at', $yesterDay)->sum($monthNow);
        $bulan_ini = Pengunjung::whereMonth('updated_at', $monthNow)->sum('total_pengunjung');
        return view('backend.pengunjung.index', compact('hari_ini', 'kemaren', 'bulan_ini'));
    }
}
