<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Api as Controller;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $events = Event::with('eventCategory')->latest()->get();
            return DataTables::of($events)->make(true);
        }
    }

    public function eventList(EventCategory $eventCategory)
    {
        $event = $eventCategory->event->load('eventCategory');
        $result['eventlist'] = $event;
        return $this->sendResponseOk($result);
    }
    public function lastEvent()
    {
        $event = Event::latest()->limit(4)->get();
        $result['lastevent'] = $event;
        return $this->sendResponseOk($result);
    }

    public function eventByCategories(EventCategory $eventCategory)
    {
        $event = $eventCategory->event->load('eventCategory');
        $result['eventlist'] = $event;
        return $this->sendResponseOk($result);
    }
}
