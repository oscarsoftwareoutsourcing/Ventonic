<?php

namespace App\Http\Controllers;

use App\Event;
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
        $events = Event::all();
        $calendarEvents = [];
        foreach ($events as $event) {
            $calendarEvents[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_at,
                'end' => $event->end_at,
                'description' => $event->notes,
                'category' => $event->category ?? 'Otros',
                'place' => $event->place ?? '',
                'color' => $event->category_color,
                'dataEventColor' => $event->category_color_class
            ];
        }
        return response()->json($calendarEvents);
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
            'start_at' => ['required', 'date'],
            'start_time' => ['required'],
            'end_at' => ['required', 'date'],
            'end_time' => ['required'],
            'notes' => ['required']
        ], [
            'start_at.required' => 'El campo de fecha inicial es obligatorio',
            'start_at.date' => 'El campo de fecha inicial no tiene un formato válido',
            'start_time.required' => 'El campo de hora inicial es obligatorio',
            'end_at.required' => 'El campo de fecha final es obligatorio',
            'end_at.date' => 'El campo de fecha final no tiene un formato válido',
            'end_time.required' => 'El campo de hora final es obligatorio',
            'notes.required' => 'El campo descripción es obligatorio'
        ]);

        Event::create([
            'category' => $this->setCategory($request->category),
            'title' => $request->title,
            'start_at' => $request->start_at . ' ' . $request->start_time.':00',
            'end_at' => $request->end_at . ' ' . $request->end_time.':00',
            'notes' => $request->notes,
            'place' => $request->place ?? null,
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['result' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'title' => ['required'],
            'start_at' => ['required', 'date'],
            'start_time' => ['required'],
            'end_at' => ['required', 'date'],
            'end_time' => ['required'],
            'notes' => ['required']
        ], [
            'start_at.required' => 'El campo de fecha inicial es obligatorio',
            'start_at.date' => 'El campo de fecha inicial no tiene un formato válido',
            'start_time.required' => 'El campo de hora inicial es obligatorio',
            'end_at.required' => 'El campo de fecha final es obligatorio',
            'end_at.date' => 'El campo de fecha final no tiene un formato válido',
            'end_time.required' => 'El campo de hora final es obligatorio',
            'notes.required' => 'El campo descripción es obligatorio'
        ]);

        $event->title = $request->title;
        $event->start_at = $request->start_at . ' ' . $request->start_time.':00';
        $event->end_at = $request->end_at . ' ' . $request->end_time.':00';
        $event->notes = $request->notes;
        if ($request->category) {
            $event->category = $this->setCategory($request->category);
        }
        if ($request->place) {
            $event->place = $request->place;
        }
        $event->save();

        return response()->json(['result' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json(['result' => true], 200);
    }

    public function setCategory($color)
    {
        $category = '';
        switch (strtoupper($color)) {
            case '#28C76F':
                $category = 'B';
                break;
            case '#FF9F43':
                $category = 'W';
                break;
            case '#EA5455':
                $category = 'P';
                break;
            default:
                $category = 'O';
                break;
        }
        return $category;
    }

    public function lastEvents()
    {
        $events = Event::orderBy('start_at', 'desc')->get()->take(10);

        return view('events', compact('events'));
    }
}
