<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KonfirmasiAnggotaController extends Controller
{
    public function konfirmasi_anggota_baru(Request $request, $id)
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
