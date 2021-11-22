<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Models\Event;

class CalendarController extends Controller
{

    // returns calendar with event details
    public function calendar()
    {
        $data = [];
        $events = Event::all();

        foreach ($events as $event) {
            $data[] = [
                'title' => $event->name,
                'start' => $event->event_date_start,
                'end' => $event->event_date_end,
                'url' => '/event/'.$event->id,
            ];
        }

        return view('other.calendar', compact('data'));
    }
}