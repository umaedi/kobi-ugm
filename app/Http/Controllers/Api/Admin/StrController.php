<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api as Controller;


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
                'email' => $str->email,
                'name'  => $str->nama,
            ];

            return $this->sendResponseUpdate($data);
        } else {
            $data = [
                'email'     => $str->email,
                'name'      => $str->nama,
                'message'   => $request->pesan
            ];

            return $this->sendResponseUpdate($data);
        }
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
