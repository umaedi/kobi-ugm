<?php

namespace App\Repositories;

use App\Models\Document;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class DocumentRepository
{
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $documents = Document::latest()->get();
            return DataTables::of($documents)->make(true);
        }
    }

    public function getByCategory($category_id)
    {
        $documents = Document::where('category_id', $category_id)->get();
        return DataTables::of($documents)->make(true);
    }
}
