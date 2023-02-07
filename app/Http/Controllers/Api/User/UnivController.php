<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;

class UnivController extends Controller
{

    public function users(Request $request)
    {
        $user_active = Universitas::select('thn_anggota')->latest()->first();
        if ($user_active->thn_anggota !== date('Y')) {
            Universitas::where('status', 1)->update([
                'status'    => '3'
            ]);
        };

        if ($request->render) {
            $limit = $request->render;
        } else {
            $limit = 10;
        }

        if ($request->search) {
            if ($request->thn_anggota == date('Y')) {
                $data     = Universitas::select('nama_univ', 'nama_fakultas', 'jenjang', 'nama_jurusan', 'thn_anggota')->where('status', 1)
                    ->where('no_anggota', 'like', '%' . $request->search . '%')
                    ->here('nama_univ', 'like', '%' . $request->search . '%')
                    ->here('nama_fakultas', 'like', '%' . $request->search . '%')
                    ->here('nama_jurusan', 'like', '%' . $request->search . '%')
                    ->latest()->paginate();
                return  $this->sendResponseOk($data);
            } else {
                $data     = Universitas::select('nama_univ', 'nama_fakultas', 'jenjang', 'nama_jurusan', 'thn_anggota')
                    ->where('no_anggota', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_univ', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_fakultas', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_jurusan', 'like', '%' . $request->search . '%')
                    ->latest()->paginate();
                return  $this->sendResponseOk($data);
            }
        };

        if ($request->year == date('Y')) {
            $data = Universitas::select('nama_univ', 'jenjang', 'nama_fakultas', 'nama_jurusan', 'thn_anggota')
                ->where('status', 1)
                ->where('thn_anggota', $request->year)->paginate($limit);
            return  $this->sendResponseOk($data);
        } else {
            $data = Universitas::select('nama_univ', 'jenjang', 'nama_fakultas', 'nama_jurusan', 'thn_anggota')
                ->where('thn_anggota', $request->year)->paginate($limit);
            return  $this->sendResponseOk($data);
        }

        $data = Universitas::select('nama_univ', 'jenjang', 'nama_fakultas', 'nama_jurusan', 'thn_anggota')->where('status', 1)->latest()->paginate($limit);

        if ((!empty($data)) and ($data->count() != 0)) {
            $result = $data;
        } else {
            $message     = 'Your request couldn`t be found';
            return $this->sendResponseError($message, null, 202);
        }
        return  $this->sendResponseOk($result);
    }
}
