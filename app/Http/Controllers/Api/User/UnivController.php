<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;

class UnivController extends Controller
{
    public function users(Request $request)
    {

        $render = $request->render;
        if ($render) {
            $limit = $request->render;
        } else {
            $limit = 10;
        };

        $search = $request->search;
        if ($search) {
            $data     = Universitas::where('no_anggota', 'like', '%' . $request->search . '%')
                ->orWhere('nama_univ', 'like', '%' . $request->search . '%')
                ->orWhere('nama_fakultas', 'like', '%' . $request->search . '%')
                ->orWhere('nama_jurusan', 'like', '%' . $request->search . '%')
                ->latest()->paginate();
            return  $this->sendResponseOk($data);
        };

        $year = $request->year;
        if ($year) {
            $year = $request->year;
        } else {
            $data = Universitas::where('status', 1)
                ->latest()->paginate($limit);
            return  $this->sendResponseOk($data);
        }

        $data = Universitas::where('thn_anggota', $year)
            ->latest()->paginate($limit);

        if ((!empty($data)) and ($data->count() != 0)) {
            $result = $data;
        } else {
            $message     = 'Your request couldn`t be found';
            return $this->sendResponseError($message, null, 202);
        }
        return  $this->sendResponseOk($result);
    }
}
