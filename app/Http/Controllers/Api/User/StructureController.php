<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Advisor;
use App\Models\BidCurriculum;
use App\Models\Coorregion;
use App\Models\DecLetter;
use App\Models\Leader;
use App\Models\Relationship;
use App\Models\Secretary;
use App\Models\Treasurer;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function decisionLatter(Request $request)
    {
        if ($request->ajax()) {
            $decLatter = DecLetter::select('title', 'body')->latest()->first();
            $result['dec_latter'] = $decLatter;
            return $this->sendResponseOk($result);
        }
    }

    public function getAdvisor(Request $request)
    {
        $dataAdvisor = Advisor::select('name', 'department', 'photo')->where('status', 1)->get();
        if (request('search')) {
            $dataAdvisor = Advisor::where('year_start', 'like', '%' . request('search') . '%')->get();
        }

        $advisor = $dataAdvisor;
        $result['advisor'] = $advisor;
        return $this->sendResponseOk($result);
    }

    public function getChairman()
    {
        $dataChairman = Leader::select('name', 'department', 'univ', 'photo', 'year_start')->where('status', 1)->get();
        if (request('search')) {
            $dataChairman = Leader::where('year_start', 'like', '%' . request('search') . '%')->get();
        }

        $chairman = $dataChairman;
        $result['chairman'] = $chairman;
        return $this->sendResponseOk($result);
    }

    public function getSecretaries()
    {
        $dataSec = Secretary::select('name', 'photo', 'department', 'univ', 'year_start')->where('status', 1)->get();
        if (request('search')) {
            $dataSec = Secretary::where('year_start', 'like', '%' . request('search') . '%')->get();
        }
        $sec = $dataSec;
        $result['secretaries'] = $sec;
        return $this->sendResponseOk($result);
    }

    public function getTeasurer()
    {
        $dataTea = Treasurer::where('status', 1)->get();
        if (request('search')) {
            $dataTea = Treasurer::select('name', 'department', 'univ', 'photo', 'year_start')->where('year_start', 'like', '%' . request('search') . '%')->get();
        }

        $tea = $dataTea;
        $result['treasurer'] = $tea;
        return $this->sendResponseOk($result);
    }

    public function getCoorregion()
    {
        $dataRegion = Coorregion::where('status', 1)->get();
        if (request('search')) {
            $dataRegion = Coorregion::select('name', 'department', 'univ', 'photo', 'year_start')->where('year_start', 'like', '%' . request('search') . '%')->get();
        }

        $coorregion = $dataRegion;
        $result['coorregion'] = $coorregion;
        return $this->sendResponseOk($result);
    }

    public function getCurriculum()
    {
        $dataCurr = BidCurriculum::where('status', 1)->get();
        if (request('search')) {
            $dataCurr = BidCurriculum::where('year_start', 'like', '%' . request('search') . '%')->get();
        }

        $curr = $dataCurr;
        $result['curriculum'] = $curr;
        return $this->sendResponseOk($result);
    }

    public function getRelationship()
    {
        $dataRela = Relationship::where('status', 1)->get();
        if (request('search')) {
            $dataRela = BidCurriculum::select('name', 'department', 'univ', 'photo', 'year_start')->where('year_start', 'like', '%' . request('search') . '%')->get();
        }
        $rela = $dataRela;
        $result['relationship'] = $rela;
        return $this->sendResponseOk($result);
    }
}
