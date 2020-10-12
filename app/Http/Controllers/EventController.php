<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventsResource;

use App\User;
use App\Event;
use App\CalendarSetting;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (auth()->check()) {
                session()->forget('returnUrl');
                $events = User::find(auth()->user()->id)->events;

                /* Return data with view */
                return view('calender')->with(['events' => json_encode(EventsResource::collection($events))]);
            }
        } catch (\Exception $th) {
            echo $th;
        }

        return view('welcome');

        // return response()->json($calendarEvents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'start_at' => ['required', 'date_format:"d-m-Y H:i"'],
            //'start_time' => ['required'],
            'end_at' => ['required', 'date_format:"d-m-Y H:i"', 'after_or_equal:start_at'],
            //'end_time' => ['required', 'after_or_equal:start_time']
        ], [
            'title.required' => 'Dato requerido',
            'start_at.required' => 'Dato requerido',
            'start_at.date_format' => 'Debe tener un formato válido',
            //'start_time.required' => 'Dato requerido',
            'end_at.required' => 'Dato requerido',
            'end_at.date_format' => 'Debe tener un formato válido',
            'end_at.after_or_equal' => 'Debe ser posterior a Fecha de Inicio',
            /*'end_time.required' => 'Dato requerido',
            'end_time.after_or_equal' => 'Debe ser posterior a Hora de Inicio'*/
        ]);

        try {
            //$start = strtotime($request->start_at. ' '.$request->start_time);
            $start = strtotime($request->start_at);
            //$end = strtotime($request->end_at. ' '.$request->end_time);
            $end = strtotime($request->end_at);

            $startDate = date("Y-m-d H:i:s", $start);
            $endDate = date("Y-m-d H:i:s", $end);

            $event = new Event;
            $event->category = $request->category ?? 'O';
            $event->title = $request->title;
            $event->start_at = $startDate;
            $event->end_at = $endDate;
            $event->notes = $request->notes;
            $event->place = $request->place ?? null;
            $event->user_id = auth()->user()->id;

            $event->save();

            $events = User::find(auth()->user()->id)->events;

            return response()->json(['result' => true, 'events' => EventsResource::collection($events)], 200);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required'],
            'start_at' => ['required', 'date_format:"d-m-Y H:i"'],
            //'start_time' => ['required'],
            'end_at' => ['required', 'date_format:"d-m-Y H:i"', 'after_or_equal:start_at'],
            //'end_time' => ['required', 'after_or_equal:start_time']
        ], [
            'title.required' => 'Dato requerido',
            'start_at.required' => 'Dato requerido',
            'start_at.date_format' => 'Debe tener un formato válido',
            //'start_time.required' => 'Dato requerido',
            'end_at.required' => 'Dato requerido',
            'end_at.date_format' => 'Debe tener un formato válido',
            'end_at.after_or_equal' => 'Debe ser posterior a Fecha de Inicio',
            /*'end_time.required' => 'Dato requerido',
            'end_time.after_or_equal' => 'Debe ser posterior a Hora de Inicio'*/
        ]);

        try {
            $event = Event::find($id);
            //$start = strtotime($request->start_at. ' '.$request->start_time);
            $start = strtotime($request->start_at);
            //$end = strtotime($request->end_at. ' '.$request->end_time);
            $end = strtotime($request->end_at);

            $startDate = date("Y-m-d H:i:s", $start);
            $endDate = date("Y-m-d H:i:s", $end);
            $event->category = $request->category ?? 'O';
            $event->title = $request->title;
            $event->start_at = $startDate;
            $event->end_at = $endDate;
            $event->notes = $request->notes;
            $event->place = $request->place ?? null;
            $event->user_id = auth()->user()->id;

            $event->save();

            $events = User::find(auth()->user()->id)->events;

            return response()->json(['result' => true, 'events' => EventsResource::collection($events)], 200);
        } catch (\Exception $th) {
            echo $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        $events = User::find(auth()->user()->id)->events;

        return response()->json(['result' => true, 'events' => EventsResource::collection($events)], 200);
    }

    // public function setCategory($color)
    // {
    //     $category = '';
    //     switch (strtoupper($color)) {
    //         case '#28C76F':
    //             $category = 'B';
    //             break;
    //         case '#FF9F43':
    //             $category = 'W';
    //             break;
    //         case '#EA5455':
    //             $category = 'P';
    //             break;
    //         default:
    //             $category = 'O';
    //             break;
    //     }
    //     return $category;
    // }

    public function lastEvents()
    {
        $events = Event::orderBy('start_at', 'desc')->get()->take(10);

        return view('events', compact('events'));
    }

    public function hasExternalCalendars()
    {
        $calendarSettings = CalendarSetting::where('user_id', auth()->user()->id)->get();
        $hasCalendars = (!$calendarSettings->isEmpty());
        $gCalendar = (!$calendarSettings->isEmpty());

        return response()->json([
            'result' => true, 'hasCalendars' => $hasCalendars, 'gCalendar' => $gCalendar
        ], 200);
    }
}
