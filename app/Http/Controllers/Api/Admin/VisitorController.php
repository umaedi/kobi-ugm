<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api as Controller;
use App\Models\Pengunjung;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $visitor = Pengunjung::query();
        $month = Carbon::now()->format('m');
        if ($request->bulan) {
            $visitor->whereMonth('updated_at', $request->bulan);
        }
        $total_visitor = $visitor->sum('total_pengunjung');
        return $this->sendResponseOk($total_visitor);
    }
}
