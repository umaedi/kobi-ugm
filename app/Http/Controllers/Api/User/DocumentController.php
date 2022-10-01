<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\Repositories\DocumentRepository;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    public function publication(Request $request)
    {
        if ($request->ajax()) {
            $publication = Publikasi::all();
            return DataTables::of($publication)->make(true);
        }
    }
}
