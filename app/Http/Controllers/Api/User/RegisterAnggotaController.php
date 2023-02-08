<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Facades\Validator;

class RegisterAnggotaController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pendaftar'     => 'required',
            'nama_univ'     => 'required',
            'nama_fakultas' => 'required',
            'email_user'    => 'required',
            'nama_jurusan'  => 'required',
            'email_kaprodi' => 'required',
            'alamat'        => 'required',
            'province_id'   => 'required',
            'regency_id'    => 'required',
            'no_tlp'        => 'required',
            'no_wa'         => 'required',
            'kode_pos'      => 'required',
            'bukti_pembayaran' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
            'uang_pangkal' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
            'status'        => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $struk = $request->file('bukti_pembayaran');
        $struk->storeAs('public/strukpembayaran', $struk->hashName());

        $uang_pangkal = $request->file('uang_pangkal');
        $uang_pangkal->storeAs('public/strukpembayaran', $uang_pangkal->hashName());

        $user = Universitas::create([
            'nama_pendaftar'    => $request->nama_pendaftar,
            'nama_univ'     => $request->nama_univ,
            'nama_fakultas' => $request->nama_fakultas,
            'jenjang'       => $request->jenjang_studi,
            'thn_anggota'   => date('Y'),
            'email_user'    => $request->email_user,
            'nama_jurusan'  => $request->nama_jurusan,
            'email_kaprodi' => $request->email_kaprodi,
            'alamat'        => $request->alamat,
            'province_id'   => $request->province_id,
            'regency_id'    => $request->regency_id,
            'no_tlp'        => $request->no_tlp,
            'no_wa'         => $request->no_wa,
            'kode_pos'      => $request->kode_pos,
            'bukti_pembayaran' => $struk->hashName(),
            'uang_pangkal'  => $uang_pangkal->hashName(),
            'status'        => $request->status
        ]);

        return $this->sendResponseCreate($user);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_anggota'    => 'required',
            'nama_univ'     => 'required',
            'nama_fakultas' => 'required',
            'email_user'    => 'required',
            'nama_jurusan'  => 'required',
            'email_kaprodi' => 'required',
            'jenjang_studi' => 'required',
            'alamat'        => 'required',
            'province_id'   => 'required',
            'regency_id'    => 'required',
            'no_tlp'        => 'required',
            'no_wa'         => 'required',
            'kode_pos'      => 'required',
            'bukti_pembayaran' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
            'status'        => 'required'

        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $user = Universitas::where('no_anggota', $request->no_anggota)->first();

        if (empty($user)) {
            return $this->sendResponseNotFound($user);
        }

        $struk = $request->file('bukti_pembayaran');
        $struk->storeAs('public/strukpembayaran', $struk->hashName());

        $user = Universitas::create([
            'nama_univ'     => $request->nama_univ,
            'nama_fakultas' => $request->nama_fakultas,
            'jenjang'       => $request->jenjang_studi,
            'thn_anggota'   => date('Y'),
            'email_user'    => $request->email_user,
            'nama_jurusan'  => $request->nama_jurusan,
            'email_kaprodi' => $request->email_kaprodi,
            'alamat'        => $request->alamat,
            'province_id'   => $request->province_id,
            'regency_id'    => $request->regency_id,
            'no_tlp'        => $request->no_tlp,
            'no_wa'         => $request->no_wa,
            'kode_pos'      => $request->kode_pos,
            'bukti_pembayaran' => $struk->hashName(),
            'status'        => $request->status,
        ]);

        return $this->sendResponseCreate($user);
    }
}
