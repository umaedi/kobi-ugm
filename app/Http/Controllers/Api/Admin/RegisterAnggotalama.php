<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api as Controller;
use App\Models\Universitas;
use Illuminate\Http\Request;

class RegisterAnggotalama extends Controller
{
    public function store(Request $request)
    {
        $no_anggota = Universitas::where('no_anggota', $request->no_anggota)->first();
        if (empty($no_anggota)) {
            return response()->json([
                'success'   => false,
                'message'   => 'No Anggota tidak ditemukan!',
            ], 202);
        }

        dd('ok');
    }
}
