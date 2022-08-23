<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api as Controller;
use App\Models\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function index(Request $request, $id)
    {
        $validator = Validator::make($request->only('pesan'), [
            'pesan' => 'required'
        ]);

        if ($validator->errors()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        $pesan = Str::findOrfail($id);
        $pesan->update('pesan', $request->pesan);
        return $this->sendResponseUpdate($pesan);
    }
}
