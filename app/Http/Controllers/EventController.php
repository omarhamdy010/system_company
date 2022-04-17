<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use LaravelFullCalendar\Facades\Calendar;

class EventController extends Controller
{
    public function index(Request $request)
    {
//        $events = [];
//        $data = Event::all();
//        if($data->count()) {
//            foreach ($data as $key => $value) {
//                $events[] = Calendar::event(
//                    $value->title,
//                    true,
//                    new \DateTime($value->start_date),
//                    new \DateTime($value->end_date.' +1 day'),
//                    null,
//                    // Add color and link on event
//                    [
//                        'color' => '#f05050',
//                        'url' => 'pass here url and any route',
//                    ]
//                );
//            }
//        }
//        $calendar = Calendar::addEvents($events);
        if($request->ajax()) {

            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }
        return view('dashboard.user_page.fullcalender');
    }
    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }

}
