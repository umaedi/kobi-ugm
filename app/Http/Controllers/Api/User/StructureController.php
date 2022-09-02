<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Adviser;
use App\Models\DecLetter;
use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function getLeader()
    {
        $advisor = Structure::where('department_id', 0)->get();
        $result['advisor'] = $advisor;
        return $this->sendResponseOk($result);
    }

    public function getMember()
    {
        $advisor = Structure::where('department_id', 2)->get();
        $result['member'] = $advisor;
        return $this->sendResponseOk($result);
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
