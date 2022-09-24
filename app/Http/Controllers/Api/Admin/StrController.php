<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Str;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api as Controller;
use App\Http\Controllers\BaseController;
use App\Mail\KonfirmasiStr;
use App\Mail\TolakStr;

class StrController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $str = Str::where('status', 0)->latest()->get();
            return DataTables::of($str)->make(true);
        }
    }

    public function strVerif(Request $request)
    {
        if ($request->ajax()) {
            $str = Str::where('status', 1)->latest()->get();
            return DataTables::of($str)->make(true);
        }
    }

    public function strReject(Request $request)
    {
        if ($request->ajax()) {
            $str = Str::where('status', 2)->latest()->get();
            return DataTables::of($str)->make(true);
        }
    }

    public function strUpdate(Request $request, $id)
    {
        $str = Str::findOrfail($id);
        $strUpdate = Str::where('id', $str->id)->update([
            'status' => $request->status,
            'pesan'  => $request->pesan
        ]);

        if ($request->pesan == '') {
            $data = [
                'name'      => $str->nama,
            ];
            Mail::to($str->email)->send(new KonfirmasiStr($data));
            return $this->sendResponseUpdate($strUpdate);
        }

        $data = [
            'name'      => $str->nama,
            'message'   => $request->pesan
        ];

        Mail::to($str->email)->send(new TolakStr($data));
        return $this->sendResponseUpdate($strUpdate);
    }

    public function strDestroy($id)
    {
        $str = Str::findOrfail($id)->first();
        if ($str->ijazah) {
            Storage::disk('local')->delete('public/docstr/' . basename($str->ijazah));
        }
        if ($str->surat_permohonan) {
            Storage::disk('local')->delete('public/docstr/' . basename($str->surat_permohonan));
        }
        if ($str->surat_pengantar) {
            Storage::disk('local')->delete('public/docstr/' . basename($str->surat_pengantar));
        }
        $str->destroy($id);
        return $this->sendResponseDelete($str);
    }
}
