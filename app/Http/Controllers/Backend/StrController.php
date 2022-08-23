<?php

namespace App\Http\Controllers\Backend;

use App\Models\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.str.index');
    }

    public function strShow($id)
    {
        $str = Str::findOrfail($id);
        return view('backend.str.show', [
            'str'   => $str
        ]);
    }

    public function strVerif()
    {
        return view('backend.str.verif');
    }

    public function strReject()
    {
        return view('backend.str.reject');
    }
}
