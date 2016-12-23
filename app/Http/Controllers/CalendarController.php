<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/22/2016
 * Time: 1:30 PM
 */

namespace App\Http\Controllers;

use App\User;
use App\Model\EventCalendar;

use Auth;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('calendar.index');
    }

    public function retrieveEvents()
    {
        $user = User::with('eventCalendars')->where('id', '=', Auth::user()->id);

        dd($user);

        return $user;
    }

    public function storeEvent(Request $request)
    {
        $user = User::whereId(Auth::user()->id);

        $eventc = new EventCalendar();

        $eventc->event_title = $request->input('event_title');
        $eventc->start_date = $request->input('start_date');
        $eventc->end_date = $request->input('end_date');
        $eventc->ext_url = $request->input('ext_url');

        $user->eventCalendars()->create($eventc);

        return redirect()->route('db.user.calendar.show');
    }
}