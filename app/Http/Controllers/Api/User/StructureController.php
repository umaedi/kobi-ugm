<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Adviser;
use App\Models\DecLetter;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function adviser(Request $request)
    {
        if ($request->ajax()) {
            $pns = Adviser::where('status', 1)->get();
            $result['adviser'] = $pns;
            return $this->sendResponseOk($result);
        }
    }

    public function decisionLatter(Request $request)
    {
        if ($request->ajax()) {
            $decLatter = DecLetter::latest()->first();
            $result['dec_latter'] = $decLatter;
            return $this->sendResponseOk($result);
        }
    }
}
