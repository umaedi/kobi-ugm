<?php

namespace App\Http\Controllers\Api;

use App\Mail\SendMail;
use App\Models\Universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api as Controller;

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
            'status'        => 'required'

        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->no_anggota == "") {
            // create user_id
            $data = DB::table('universitas')->select('no_anggota')->orderBy('created_at', 'DESC')->first();
            $userId = substr($data->no_anggota, -4);

            $no_anggota = $userId;
            if ($no_anggota <= $userId) {
                $no_anggota++;
            }

            $year = substr(date('Y'), -2);

            $user_id = 'KOBI-' . $request->jenjang_studi . '-' . $year . '-' . 0 . $no_anggota;
        } else {
            $dataNoAnggota = DB::table('universitas')->where('no_anggota', $request->no_anggota)->first();
            if ($dataNoAnggota == null) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'No Anggota tidak ditemukan',
                ], 404);
            } else {
                $user_id = $request->no_anggota;
            }
        }


        $struk = $request->file('bukti_pembayaran');
        $struk->storeAs('public/struk', $struk->hashName());

        $univ = Universitas::create([
            'nama_univ'     => $request->nama_univ,
            'no_anggota'    => $user_id,
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
            'bukti_pembayaran' => $struk->hashName(),
            'status'        => $request->status
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
        }

        $noAnggota = $universitas->no_anggota;
        $pesan = [
            'pesan' => '<p>Terimakasih sudah mendaftar untuk menjadi bagian dari KOBI.</p> 
            <p> Berikut no anggota Anda ' . $noAnggota . '</p>
            Selamat bergabung dan salam hangat dari kami <br>
            <br>
            <h4>Salam hormat</h4>
            <p>Admin KOBI</p>'
        ];

        $emailAnggota = $universitas->email_user;
        Mail::to($emailAnggota)->send(new SendMail($pesan));
        return $this->sendResponseUpdate($universitas);
    }

    public function destroy($id)
    {
        $user = Universitas::findOrfail($id);
        if ($user->bukti_pembayaran) {
            Storage::disk('local')->delete('public/struk/' . basename($user->bukti_pembayaran));
            $user->destroy($id);
        }
        return $this->sendResponseDelete($user);
    }
}
