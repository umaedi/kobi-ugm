<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use App\Models\Adviser;
use App\Models\Advisor;
use App\Models\Founder;
use App\Models\Gallery;
use App\Models\Structur;
use App\Models\Struktur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BidCurriculum;
use App\Models\Coordinator;
use App\Models\DecLetter;
use App\Models\Kurikulum;
use App\Models\Structure;
use App\Models\Universitas;
use App\Models\VisiMisi;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }

    public function visiMisi()
    {
        return view('backend.visi-misi.visiMisi', [
            'visi'     => VisiMisi::latest()->first()
        ]);
    }

    public function users()
    {
        return view('backend.users.index');
    }

    public function newUserDetail($id)
    {
        $anggota = Universitas::findOrfail($id);
        return view('backend.users.edit', [
            'anggota' => $anggota
        ]);
    }

    public function userEdit($id)
    {
        $anggota = Universitas::findOrfail($id);
        return view('backend.users.edit', [
            'anggota' => $anggota
        ]);
    }

    public function usersActive()
    {
        return view('backend.users.active');
    }

    public function usersNonActive()
    {
        return view('backend.users.nonActive');
    }

    public function usersNonActiveEdit($id)
    {
        $anggota = Universitas::findOrfail($id);
        return view('backend.users.edit-tolak', [
            'anggota' => $anggota
        ]);
    }

    public function media()
    {
        $data['nav'] = 'Posts';
        return view('backend.media.index', compact('data'));
    }

    public function strShow($id)
    {
        return view('backend.str.show');
    }

    public function categories()
    {
        return view('backend.categories.index');
    }

    public function naskah()
    {
        return view('backend.naskah.index');
    }

    public function publikasi()
    {
        return view('backend.publikasi.index');
    }

    public function adArt()
    {
        return view('backend.ad-art.index');
    }

    public function kurikulum()
    {
        return view('backend.kurikulum.index');
    }

    public function editKurikulum($id)
    {
        $dokKurikulum = Kurikulum::findOrfail($id)->first();
        return view('backend.kurikulum.edit', [
            'kurikulum' => $dokKurikulum
        ]);
    }

    public function laporan()
    {
        return view('backend.laporan.index');
    }

    public function event()
    {
        return view('backend.event.index');
    }

    public function createEvenet()
    {
        return view('backend.event.create');
    }

    public function eventKategori()
    {
        return view('backend.event-category.index');
    }

    public function sejarah()
    {
        return view('backend.sejarah.index', [
            'about' => About::get()->first(),
            'founders'  => Founder::latest()->get()
        ]);
    }

    public function struktur()
    {
        return view('backend.struktur.index', [

            'AdvisorLead'       => Structure::where('department_id', 0)->get(),
            'members'           => Structure::where('department_id', 3)->get(),
            'structuresLead'    => Structure::where('department_id', 1)->get(),
            'sekretaris'        => Structure::where('department_id', 4)->get(),
            'bendahara'         => Structure::where('department_id', 5)->get(),
            'iDbagian'          => Coordinator::where('status', 1)->get(),
            'curriculums'       => BidCurriculum::where('status', 1)->get(),
            'humas'             => Structure::where('department_id', 8)->get(),

        ]);
    }

    public function galeri()
    {
        return view('backend.galeri.index', [
            'galleries' => Gallery::latest()->paginate(12)
        ]);
    }
}
