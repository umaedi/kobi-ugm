<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;
use App\Models\User;

class KonfirmasiAnggotaController extends Controller
{
    public function konfirmasi_anggota(Request $request, $id)
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
        $user = User::where('email', $universitas->email_user)->first();
        if ($user) {
            $user->update([
                'no_anggota'    => $universitas->no_anggota,
                'name'  => 'anggota',
                'email' => $universitas->email_user,
                'password'  => bcrypt($password)
            ]);
        } else {
            $user = User::create([
                'no_anggota'    => $universitas->no_anggota,
                'name'  => 'anggota',
                'email' => $universitas->email_user,
                'password'  => bcrypt($password)
            ]);
        }
        $data = [
            'email' => $universitas->email_user,
            'no_anggota'    => $universitas->no_anggota,
            'password'      => $password
        ];
        return $this->sendResponseUpdate($data);
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
