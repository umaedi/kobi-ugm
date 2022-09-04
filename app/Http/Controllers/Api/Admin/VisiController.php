<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Facades\Validator;

class VisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { {
            $about = VisiMisi::findOrfail($id)->first();
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'body'  => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
            }

            $about->update([
                'title' => $request->title,
                'body'  => $request->body,
                'status'    => $request->status
            ]);

            return $this->sendResponseUpdate($about);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
