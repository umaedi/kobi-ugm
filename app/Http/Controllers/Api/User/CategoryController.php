<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $result['categories'] = $categories;
        return $this->sendResponseOk($result);
    }
}
