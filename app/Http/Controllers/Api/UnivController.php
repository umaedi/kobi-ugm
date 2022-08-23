<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;
use App\Models\Universitas;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UnivController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $universitas = Universitas::where('verifikasi', 1)->latest()->get();
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
            'nama_kajur'    => 'required',
            'nama_jurusan'  => 'required',
            'email_kaprodi' => 'required',
            'alamat'        => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'no_tlp'        => 'required',
            'no_wa'         => 'required',
            'kode_pos'      => 'required',
            'bukti_pembayaran' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $struk = $request->file('bukti_pembayaran');
        $struk->storeAs('public/struk', $struk->hashName());

        $univ = Universitas::create([
            'nama_univ'     => $request->nama_univ,
            'user_id'       => '1',
            'nama_kajur'    => $request->nama_kajur,
            'nama_jurusan'  => $request->nama_jurusan,
            'email_kaprodi' => $request->email_kaprodi,
            'alamat'        => $request->alamat,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'no_tlp'        => $request->no_tlp,
            'no_wa'         => $request->no_wa,
            'kode_pos'      => $request->kode_pos,
            'no_anggota'      => $request->no_anggota,
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
        //
    }

    public function destroy($id)
    {
        //
    }
}
