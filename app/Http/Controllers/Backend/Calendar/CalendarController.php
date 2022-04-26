<?php

namespace App\Http\Controllers\Backend\Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\Client;

class CalendarController extends Controller
{
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all();
        $calendar_data = [];

        return view('backend.calendar.index')->with('calendar_data', $calendar_data);
    }
}