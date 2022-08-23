<?php

namespace App\Repositories;

use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryRepository
{
    public function getAll()
    {
        $category = Category::latest()->get();
        return DataTables::of($category)->make(true);
    }

    public function store()
    {
        //
    }
}
