<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api as Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function update(Request $request, $id)
    {
        $about = About::findOrfail($id)->first();
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
