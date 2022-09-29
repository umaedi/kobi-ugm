<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Str;
use App\Models\Struk;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;

class StrController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required',
            'program_studi' => 'required',
            'universitas'   => 'required',
            'no_hp'         => 'required',
            'email'         => 'required',
            'nama_perusahaan'   => 'required',
            'ijazah'        => 'required|mimes:pdf|max:3072',
            'surat_permohonan'  => 'required|mimes:pdf|max:3072',
            'surat_pengantar'   => 'required|mimes:pdf|max:3072',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('ijazah')) {
            $ijazah = $request->file('ijazah');
            $ijazah->storeAs('public/docstr', $ijazah->hashName());
        }
        if ($request->file('surat_permohonan')) {
            $surat_permohonan = $request->file('surat_permohonan');
            $surat_permohonan->storeAs('public/docstr', $surat_permohonan->hashName());
        }
        if ($request->file('surat_pengantar')) {
            $surat_pengantar = $request->file('surat_pengantar');
            $surat_pengantar->storeAs('public/docstr', $surat_pengantar->hashName());
        }

        $str = Str::create([
            'nama'          => $request->nama,
            'program_studi' => $request->program_studi,
            'universitas'   => $request->universitas,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
            'nama_perusahaan'   => $request->nama_perusahaan,
            'ijazah'        => $ijazah->hashName(),
            'surat_permohonan'  => $surat_permohonan->hashName(),
            'surat_pengantar'   => $surat_pengantar->hashName(),
            'status'            => '0'
        ]);

        $result['str'] = $str;
        return $this->sendResponseCreate($result);
    }

    public function uploadStr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'struk'     => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('struk')) {
            $struk = $request->file('struk');
            $struk->storeAs('public/struk', $struk->hashName());
        }
        $struk = Struk::create([
            'email'     => $request->email,
            'struk'     => $struk->hashName()
        ]);

        $result['struk'] = $struk;
        return $this->sendResponseCreate($request);
    }
}
