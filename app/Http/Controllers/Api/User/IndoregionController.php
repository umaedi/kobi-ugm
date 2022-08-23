<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Regency;
use App\Http\Controllers\Api as Controller;

class IndoregionController extends Controller
{
    public function kabupaten($id)
    {
        $kabupaten = Regency::where('province_id', $id)->get();
        $result['kabupten'] = $kabupaten;
        return $this->sendResponseOk($result);
    }
}
