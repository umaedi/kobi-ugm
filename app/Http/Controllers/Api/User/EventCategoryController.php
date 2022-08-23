<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $evcat = EventCategory::latest()->get();
        $evact['evcat'] = $evcat;
        return $this->sendResponseOk($evact);
    }
}
