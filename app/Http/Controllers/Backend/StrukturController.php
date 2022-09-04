<?php

namespace App\Http\Controllers\Backend;

use App\Models\DecLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advisor;
use App\Models\BidCurriculum;
use App\Models\Coorregion;
use App\Models\Leader;
use App\Models\Relationship;
use App\Models\Secretary;
use App\Models\Treasurer;

class StrukturController extends Controller
{
    public function suratKeputusan()
    {
        return view('backend.struktur.surat', [
            'decLatter' => DecLetter::where('status', 1)->first(),
        ]);
    }

    public function dewanPenasiaht()
    {
        return view('backend.struktur.penasihat', [
            'advisors' => Advisor::where('status', 1)->get(),
        ]);
    }

    public function ketuaWakil()
    {
        return view('backend.struktur.ketwakil', [
            'structures' => Leader::where('status', 1)->get(),
        ]);
    }

    public function sekretaris()
    {
        return view('backend.struktur.sekretaris', [
            'structures' => Secretary::where('status', 1)->get(),
        ]);
    }

    public function bendahara()
    {
        return view('backend.struktur.bendahara', [
            'structures' => Treasurer::where('status', 1)->get(),
        ]);
    }

    public function koorWlayah()
    {
        return view('backend.struktur.koorwilayah', [
            'structures' => Coorregion::where('status', 1)->get(),
        ]);
    }

    public function koorKurikulum()
    {
        return view('backend.struktur.koorkurikulum', [
            'structures' => BidCurriculum::where('status', 1)->get(),
        ]);
    }

    public function humas()
    {
        return view('backend.struktur.humas', [
            'structures' => Relationship::where('status', 1)->get(),
        ]);
    }
}
