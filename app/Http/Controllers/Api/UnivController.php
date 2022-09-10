<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;
use App\Models\Universitas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UnivController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $universitas = Universitas::where('status', 1)->latest()->get();
            return DataTables::of($universitas)->make(true);
        }
    }

    public function create()
    {
        //
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

        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $struk = $request->file('bukti_pembayaran');
        $struk->storeAs('public/struk', $struk->hashName());

        $univ = Universitas::create([
            'nama_univ'     => $request->nama_univ,
            'nama_fakultas' => $request->nama_fakultas,
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
            'bukti_pembayaran' => $struk->hashName()
        ]);

        return $this->sendResponseCreate($univ);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //create user_id
        $data = DB::table('universitas')->select('user_id')->orderBy('updated_at', 'DESC')->first();
        $userId = $data->user_id;
        $userId = substr($userId, -3);

        $no_anggota = $userId;
        if ($no_anggota <= $userId) {
            $no_anggota++;
        }

        $year = substr(date('Y'), -2);

        $user_id = 'KOBI-S1' . '-' . $year . '-' . +0 . $no_anggota;
        return $this->sendResponseError(json_encode($user_id));

        $universitas = Universitas::findOrfail($id);
        if ($request->pesan == "") {
            $universitas->where('id', $id)->update([
                'status'    => $request->status,
                'user_id'   => $user_id
            ]);
        }

        return $this->sendResponseUpdate($universitas);
    }

    public function destroy($id)
    {
        //
    }
}
