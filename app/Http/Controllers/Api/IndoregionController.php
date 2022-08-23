<?php

namespace App\Http\Controllers\Api;

use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;

class IndoregionController extends Controller
{
    public function provinsi()
    {
        $provinsi = Province::get();
        $result['provinsi'] = $provinsi;
        return $this->sendResponseOk($result);
    }

    public function kabupaten($id)
    {
        $kabupaten = Regency::where('province_id', $id)->get();
        $result['kabupten'] = $kabupaten;
        return $this->sendResponseOk($result);
    }
}
