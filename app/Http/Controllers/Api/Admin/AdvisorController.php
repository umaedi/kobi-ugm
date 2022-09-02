<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Advisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Api as Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdvisorController extends Controller
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
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255',
            'year_start'    => 'required',
            'year_end'    => 'required',
            'photo'     => 'required|mimes:jpg,jpeg,png|file|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $photo->storeAs('public/xstruktur', $photo->hashName());
        }

        $advisor = Advisor::create([
            'name'      => $request->name,
            'department_id'  => $request->department_id,
            'univ'      => $request->univ,
            'year_start'    => $request->year_start,
            'year_end'      => $request->year_end,
            'photo'     => $photo->hashName(),
            'status'    => $request->status,
        ]);

        if ($advisor) {
            return $this->sendResponseCreate($advisor);
        }
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
    {
        $dataAdvisor = Advisor::findOrfail($id);
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:255',
            'year_start'    => 'required',
            'year_end'      => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
        }

        if ($request->file('photo') == '') {
            $dataAdvisor->update([
                'name'      => $request->name,
                'department_id'  => $request->department_id,
                'univ'      => $request->univ,
                'year_start'    => $request->year_start,
                'year_end'      => $request->year_end,
                'photo'     => $dataAdvisor->photo,
                'status'    => $request->status,
            ]);

            return $this->sendResponseUpdate($dataAdvisor);
        } else {
            Storage::disk('local')->delete('public/xstruktur/' . basename($dataAdvisor->photo));
            $photo = $request->file('photo');
            $photo->storeAs('public/xstruktur', $photo->hashName());

            $dataAdvisor->update([
                'name'      => $request->name,
                'department_id'  => $request->department_id,
                'univ'      => $request->univ,
                'year_start'    => $request->year_start,
                'year_end'      => $request->year_end,
                'photo'     => $photo->hashName(),
                'status'    => $request->status,
            ]);

            if ($dataAdvisor) {
                return $this->sendResponseUpdate($dataAdvisor);
            }
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
        $dataAdvisor = Advisor::findOrfail($id);
        if ($dataAdvisor->photo) {
            Storage::disk('local')->delete('public/xstruktur/' . basename($dataAdvisor->photo));
        }

        $dataAdvisor->destroy($id);
        return $this->sendResponseDelete($dataAdvisor);
    }
}
