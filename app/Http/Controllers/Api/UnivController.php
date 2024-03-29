<?php

namespace App\Http\Controllers\Api;

use App\Models\Universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;
use App\Models\User;

class UnivController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $universitas = Universitas::where('status', 0)->latest()->get();
            return DataTables::of($universitas)->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'status'        => 'required'

        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $struk = $request->file('bukti_pembayaran');
        $struk->storeAs('public/strukpembayaran', $struk->hashName());

        $univ = Universitas::create([
            'nama_univ'     => $request->nama_univ,
            'nama_fakultas' => $request->nama_fakultas,
            'jenjang'       => $request->jenjang_studi,
            'thn_anggota'   => date('Y'),
            'user_id'       => $request->user_id,
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
            'status'        => $request->status
        ]);

        return $this->sendResponseCreate($univ);
    }

    public function update(Request $request, $id)
    {

        $universitas = Universitas::findOrfail($id);
        if ($request->pesan == "") {
            $universitas->where('id', $id)->update([
                'status'    => $request->status,
            ]);
        } else {
            $universitas->where('id', $id)->update([
                'status'    => $request->status,
                'pesan'     => $request->pesan
            ]);

            $data = [
                'email'    => $universitas->email_user,
                'message'  => $request->pesan,
            ];

            return $this->sendResponseUpdate($data);
        }

        $password = $this->generatePassword();

        $data_user = User::where('email', $universitas->email_user)->first();
        if ($data_user == null) {
            User::create([
                'no_anggota'    => $universitas->no_anggota,
                'name'          => $request->nama_jurusan,
                'email'         => $universitas->email_user,
                'password'      => bcrypt($password)
            ]);
        } else {
            User::where('email', $data_user->email)->update([
                'no_anggota'    => $universitas->no_anggota,
                'name'          => $request->nama_jurusan,
                'email'         => $universitas->email_user,
                'password'      => bcrypt($password)
            ]);

            $noAnggota = $universitas->no_anggota;
            $data = [
                'email'     => $data_user->email,
                'noAnggota' => $noAnggota,
                'password'  => $password
            ];
            return $this->sendResponseUpdate($data);
        }

        $noAnggota = $universitas->no_anggota;
        $data = [
            'email'     => $universitas->email_user,
            'noAnggota' => $noAnggota,
            'password'  => $password
        ];

        return $this->sendResponseUpdate($data);
    }

    public function destroy($id)
    {
        $user = Universitas::findOrfail($id);
        if ($user->bukti_pembayaran) {
            Storage::disk('local')->delete('public/strukpembayaran/' . basename($user->bukti_pembayaran));
            $user->destroy($id);
        }
        return $this->sendResponseDelete($user);
    }

    private function generatePassword()
    {
        $number = random_int(
            min: 000_000,
            max: 999_999,
        );

        return str_pad(
            string: strval($number),
            length: 6,
            pad_string: '0',
            pad_type: STR_PAD_LEFT,
        );
    }
}
