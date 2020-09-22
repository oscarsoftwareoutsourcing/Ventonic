<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Carbon\Carbon;
use App\Event;
use App\CalendarSetting;

class GoogleCalendarController extends Controller
{
    protected $client;

    public function __construct()
    {
        $rurl = action('GoogleCalendarController@oauth');

        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-calendar/client_id.json'));
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new GuzzleClient([
            'curl' => [CURLOPT_SSL_VERIFYPEER => false]
        ]);
        $client->setHttpClient($guzzleClient);

        $this->client = $client;
    }

    /*public function checkToken()
    {
        $client = new GuzzleClient();
        $response = $client->request('GET', 'https://www.googleapis.com/drive/v2/files', [
            'access_token' => session('access_token')['access_token']
        ]);
        dd($response->getBody());
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('access_token') && session('access_token')) {
            $this->client->setAccessToken(session()->get('access_token'));

            //$this->client->authenticate(session('google-calendar-code'));
            $service = new Google_Service_Calendar($this->client);
            $results = $service->events->listEvents('primary');

            foreach ($results->getItems() as $result) {
                $startAt = str_replace("T", " ", $result->getStart()->dateTime);
                $endAt = str_replace("T", " ", $result->getEnd()->dateTime);

                if (empty($startAt)) {
                    $startAt = $result->getStart()->date . ' 00:00:00-00:00';
                }
                if (empty($endAt)) {
                    $endAt = $result->getStart()->date . ' 23:59:59-00:00';
                }

                $event = Event::updateOrCreate(
                    [
                        'title' => $result->getSummary(),
                        'start_at' => substr($startAt, 0, -6),
                        'end_at' => substr($endAt, 0, -6),
                        'user_id' => auth()->user()->id
                    ],
                    [
                        'category' => 'O',
                        'notes' => $result->getDescription() ?? '',
                        'place' => null,
                    ]
                );
            }

            //return response()->json(['result' => true, 'events' => $results->getItems()], 200);
            session()->flash('message', 'Calendario de google configurado con éxito');
            return redirect()->route('events.index');
        }

        return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
        //return redirect('/google-calendar/oauth');
    }

    public function oauth()
    {
        if (!isset($_GET['code'])) {
            $authUrl = $this->client->createAuthUrl();
            $filteredUrl = filter_var($authUrl, FILTER_SANITIZE_URL);
            return redirect($filteredUrl);
        }

        $this->client->authenticate($_GET['code']);
        session()->put('google-calendar-code', $_GET['code']);
        session()->put('access_token', $this->client->getAccessToken());
        CalendarSetting::updateOrCreate(
            ['appType' => 'gCalendar', 'user_id' => auth()->user()->id],
            ['token' => json_encode(session('access_token'))]
        );

        return redirect('/google-calendar');
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
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'end_time' => ['required', 'after_or_equal:start_time']
        ], [
            'title.required' => 'Dato requerido',
            'start_at.required' => 'Dato requerido',
            'start_at.date' => 'Debe tener un formato válido',
            'start_time.required' => 'Dato requerido',
            'end_at.required' => 'Dato requerido',
            'end_at.date' => 'Debe tener un formato válido',
            'end_at.after_or_equal' => 'Debe ser posterior a Fecha de Inicio',
            'end_time.required' => 'Dato requerido',
            'end_time.after_or_equal' => 'Debe ser posterior a Hora de Inicio'
        ]);

        $startDateTime = $request->start_at . ' ' . $request->start_time;
        $endDateTime = $request->end_at . ' ' . $request->end_time;

        if (session()->has('access_token') && session('access_token')) {
            $this->client->setAccessToken(session('access_token'));
            $service = new Google_Service_Calendar($this->client);

            $event = new Google_Service_Calendar_Event([
                'summary' => $request->title,
                'description' => $request->notes ?? '',
                'start' => ['dateTime' => $startDateTime],
                'end' => ['dateTime' => $endDateTime],
                'reminders' => ['useDefault' => true]
            ]);

            $results = $service->events->insert('primary', $event);

            if (!$results) {
                return response()->json([
                    'result' => false, 'error' => 'Error al registra el evento en google calendar'
                ], 200);
            }

            return response()->json(['result' => true], 200);
        }

        return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required'],
            'start_at' => ['required', 'date'],
            'start_time' => ['required'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'end_time' => ['required', 'after_or_equal:start_time']
        ], [
            'title.required' => 'Dato requerido',
            'start_at.required' => 'Dato requerido',
            'start_at.date' => 'Debe tener un formato válido',
            'start_time.required' => 'Dato requerido',
            'end_at.required' => 'Dato requerido',
            'end_at.date' => 'Debe tener un formato válido',
            'end_at.after_or_equal' => 'Debe ser posterior a Fecha de Inicio',
            'end_time.required' => 'Dato requerido',
            'end_time.after_or_equal' => 'Debe ser posterior a Hora de Inicio'
        ]);

        if (session()->has('access_token') && session('access_token')) {
            $this->client->setAccessToken(session('access_token'));
            $service = new Google_Service_Calendar($this->client);

            $startDateTime = Carbon::parse($request->start_at . ' ' . $request->start_time)->toRfc3339String();
            $endDateTime = Carbon::parse($request->end_at . ' ' . $request->end_time)->toRfc3339String();
            $eventDuration = 30;

            $event = $service->events->get('primary', $id);
            $event->setSummary($request->title);
            $event->setDescription($request->notes ?? '');
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);

            $updatedEvent = $service->events->update('primary', $event->getId(), $event);

            if (!$event) {
                return response()->json(['result' => false, 'error' => 'Error al actualizar el evento']);
            }

            return response()->json(['result' => true, 'data' => $updatedEvent]);
        }

        return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (session()->has('access_token') && session('access_token')) {
            $this->client->setAccessToken(session('access_token'));
            $service = new Google_Service_Calendar($this->client);
            $service->events->delete('primary', $id);
            return response()->json(['result' => true], 200);
        }

        return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
    }

    /**
     * Obtiene un listado de los calendarios del usuario
     *
     * @method    getAllCalendarList
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    JsonResponse                Listado de calendarios
     */
    public function getAllCalendarList()
    {
        if (session()->has('access_token') && session('access_token')) {
            $this->client->setAccessToken(session('access_token'));

            $service = new Google_Service_Calendar($this->client);

            foreach ($service->calendarList->listCalendarList()->getItems() as $calendarListEntry) {
                //echo $calendarListEntry->getSummary() . "<br><br>";
                //echo $calendarListEntry->getSummary() . "<br><br>";
            }

            return response()->json(['result' => true, 'calendars' => $service->calendarList->listCalendarList()->getItems()], 200);
        }

        //return redirect('/google-calendar/oauth');
        return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
    }

    public function syncGoogleCalendar()
    {
        if (session()->has('access_token') && session('access_token')) {
            $this->client->setAccessToken(session()->get('access_token'));

            //$this->client->authenticate(session('google-calendar-code'));
            $service = new Google_Service_Calendar($this->client);
            $results = $service->events->listEvents('primary');

            /** Agrega los eventos locales al calendario de google */
            foreach (Event::all() as $evt) {
                $googleEvent = new Google_Service_Calendar_Event([
                    'summary' => $evt->title,
                    'description' => $evt->notes ?? '',
                    'start' => ['dateTime' => str_replace(" ", "T", $evt->start_at).'-00:00'],
                    'end' => ['dateTime' => str_replace(" ", "T", $evt->end_at).'-00:00'],
                    'reminders' => ['useDefault' => true]
                ]);

                $service->events->insert('primary', $googleEvent);
            }

            /** agrega los eventos de google al calendario local */
            foreach ($results->getItems() as $result) {
                $startAt = str_replace("T", " ", $result->getStart()->dateTime);
                $endAt = str_replace("T", " ", $result->getEnd()->dateTime);

                $event = Event::updateOrCreate(
                    [
                        'title' => $result->getSummary(),
                        'start_at' => substr($startAt, 0, -6),
                        'end_at' => substr($endAt, 0, -6),
                        'user_id' => auth()->user()->id
                    ],
                    [
                        'category' => 'O',
                        'notes' => $result->getDescription() ?? '',
                        'place' => null,
                    ]
                );
            }

            session()->flash('message', 'Calendario sincronizado con éxito');

            return redirect()->route('events.index');
        }

        return redirect('/google-calendar/oauth');
    }

    public function disconnect()
    {
        $calendarSetting = CalendarSetting::where(['user_id' => auth()->user()->id, 'appType' => 'gCalendar'])->first();

        if ($calendarSetting) {
            /*$this->client->setAccessToken(
                (session()->has('access_token') && session('access_token'))
                ? session()->get('access_token')
                : $calendarSetting->token
            );

            $service = new Google_Service_Calendar($this->client);
            $results = $service->events->listEvents('primary');
            foreach ($results->getItems() as $result) {
                $startAt = str_replace("T", " ", $result->getStart()->dateTime);
                $endAt = str_replace("T", " ", $result->getEnd()->dateTime);

                $event = Event::where([
                    'title' => $result->getSummary(),
                    'start_at' => substr($startAt, 0, -6),
                    'end_at' => substr($endAt, 0, -6),
                    'user_id' => auth()->user()->id
                ])->first();

                if ($event) {
                    $event->delete();
                }
            }*/
            $calendarSetting->delete();
            session()->forget(['google-calendar-code', 'access_token']);
            session()->flash('message', 'Calendario de Google eliminado con éxito');
            return response()->json(['result' => true], 200);
        }

        return response()->json(['result' => false], 200);
    }
}
