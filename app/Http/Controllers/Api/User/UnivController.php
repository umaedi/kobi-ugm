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

        $year = $request->year;
        if ($year) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }

        $sort         = $request->input('sort');
        if ($sort == '') {
            $sort = 'ASC';
        };
        $columns    = "id";

        $search = $request->search;
        if ($search) {
            $q = $request->search;
        } else {
            $q = '';
        }

        $data     = Universitas::orderBy($columns, $sort)
            ->where('thn_anggota', $year)
            ->where('no_anggota', 'like', '%' . $q . '%')
            ->paginate($limit);

        if ((!empty($data)) and ($data->count() != 0)) {

            $result = $data;
        } else {
            $message     = 'Your request couldn`t be found';
            return $this->sendResponseError($message, null, 202);
        }
        return  $this->sendResponseOk($result);
    }
}
