<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Advisor;
use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    public function getLeader()
    {
        $advisor = Advisor::where('department_id', 1)->get();
        $result['advisor'] = $advisor;
        return $this->sendResponseOk($result);
    }

    public function getMember()
    {
        $advisor = Advisor::where('department_id', 2)->get();
        $result['member'] = $advisor;
        return $this->sendResponseOk($result);
    }
}
