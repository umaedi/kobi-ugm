<?php

namespace App\Http\Controllers\Backend;

use App\Charts\VisitorChart;
use Carbon\Carbon;
use App\Models\Pengunjung;
use App\Http\Controllers\Controller;

class PengunjungController extends Controller
{
    public function index(VisitorChart $visitorChart)
    {

        $dateNow    = Carbon::now()->format('Y-m-d');
        $yearNow    = Carbon::now()->format('Y');
        $yesterDay  = Carbon::yesterday()->format('Y-m-d');
        $endWeek    = Carbon::now()->endOfWeek();
        $monthNow   = Carbon::now()->format('m');
        $startWeek  = Carbon::now()->startOfWeek();


        if (\request()->ajax()) {

            $visitor = Pengunjung::query();
            $data['table'] = $visitor->orderBy('total_pengunjung', 'DESC')->limit(12)->get();
            $data['total_pengunjung'] = $visitor->sum('total_pengunjung');
            return view('backend.pengunjung._data_table', $data);
        }

        $hari_ini = Pengunjung::whereDate('updated_at', $dateNow)->sum($monthNow);
        $kemaren = Pengunjung::whereDate('updated_at', $yesterDay)->sum($monthNow);
        $bulan_ini = Pengunjung::whereMonth('updated_at', $monthNow)->sum('total_pengunjung');
        $tahun_ini = Pengunjung::whereYear('updated_at', $yearNow)->sum('total_pengunjung');
        $visitorChart = $visitorChart->build();
        return view('backend.pengunjung.index', compact('hari_ini', 'kemaren', 'bulan_ini', 'visitorChart'));
    }
}
