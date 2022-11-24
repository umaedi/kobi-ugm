<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;

class UnivController extends Controller
{
    public function users(Request $request)
    {
        if ($request->render) {
            $limit = $request->render;
        } else {
            $limit = 1;
        }

        if ($request->year) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }

        if ($request->search) {
            $data     = Universitas::select('nama_univ', 'nama_fakultas', 'jenjang', 'nama_jurusan', 'thn_anggota')->where('no_anggota', 'like', '%' . $request->search . '%')
                ->orWhere('nama_univ', 'like', '%' . $request->search . '%')
                ->orWhere('nama_fakultas', 'like', '%' . $request->search . '%')
                ->orWhere('nama_jurusan', 'like', '%' . $request->search . '%')
                ->latest()->paginate();
            return  $this->sendResponseOk($data);
        };

        $data = Universitas::select('nama_univ', 'jenjang', 'nama_fakultas', 'nama_jurusan', 'thn_anggota')->where('thn_anggota', $year)
            ->orderBy('thn_anggota', 'DESC')->paginate($limit);

        if ((!empty($data)) and ($data->count() != 0)) {
            $result = $data;
        } else {
            $message     = 'Your request couldn`t be found';
            return $this->sendResponseError($message, null, 202);
        }
        return  $this->sendResponseOk($result);
    }
}
