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
use App\GoogleCalendar;
use App\Http\Resources\EventsResource;

//use App\User;

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

            foreach ($service->calendarList->listCalendarList()->getItems() as $calendar) {
                $results = $service->events->listEvents($calendar->getId());

                $primaryCalendar = $calendar->getPrimary();
                $calendarName = ($primaryCalendar === true) ? 'Primario' : $calendar->getSummary();

                $gCalendar = GoogleCalendar::updateOrCreate(
                    ['google_id' => $calendar->getId(), 'user_id' => auth()->user()->id],
                    [
                        'name' => $calendarName,
                        'description' => $calendar->getDescription() ?? null,
                        'color' => $calendar->getBackgroundColor()
                    ]
                );

                foreach ($results->getItems() as $result) {
                    /** Condición para evaluar solamente eventos futuros */
                    if (!empty($result->getStart()->dateTime) && Carbon::parse($result->getEnd()->dateTime) > Carbon::now()) {
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
                                'external_key' => $result->getId(),
                                'external_calendar' => 'gCalendar',
                                'eventable_type' => GoogleCalendar::class,
                                'eventable_id' => $gCalendar->id
                            ],
                            [
                                'title' => $result->getSummary(),
                                'start_at' => substr($startAt, 0, -6),
                                'end_at' => substr($endAt, 0, -6),
                                'user_id' => auth()->user()->id,
                                'category' => 'O',
                                'notes' => $result->getDescription() ?? '',
                                'place' => null,
                            ]
                        );
                    }
                }
            }

            session()->flash('message', 'Calendario de google sincronizado');
            return redirect()->route('events.index');
        }

        //return redirect('/google-calendar/oauth');
        return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
    }

    /**
     * Realiza la autenticación con Google
     *
     * @method    oauth
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    Response    Redirecciona de acuerdo a la petición solicitada
     */
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

        /** si se ha indicado una url a la cual redirigir la petición */
        if (session('returnUrl')) {
            return redirect()->route(session('returnUrl'));
        }

        return redirect('/google-calendar');
    }

    /**
     * Actualiza los datos de autenticación con Google
     *
     * @method    updateOauth
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     */
    public function updateOauth()
    {
        if (!isset($_GET['code'])) {
            $authUrl = $this->client->createAuthUrl();
            $filteredUrl = filter_var($authUrl, FILTER_SANITIZE_URL);
            return redirect($filteredUrl);
        }

        $this->client->authenticate($_GET['code']);
        session()->put('google-calendar-code', $_GET['code']);
        session()->put('access_token', $this->client->getAccessToken());
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
            if ($this->client->isAccessTokenExpired()) {
                $this->updateOauth();
            }

            $service = new Google_Service_Calendar($this->client);

            $calendars = [];

            foreach ($service->calendarList->listCalendarList()->getItems() as $calendarListEntry) {
                $primaryCalendar = $calendarListEntry->getPrimary();
                $calendarName = ($primaryCalendar === true) ? 'Primario' : $calendarListEntry->getSummary();

                $gCalendar = GoogleCalendar::updateOrCreate(
                    ['google_id' => $calendarListEntry->getId(), 'user_id' => auth()->user()->id],
                    [
                        'name' => $calendarName,
                        'description' => $calendarListEntry->getDescription() ?? null,
                        'color' => $calendarListEntry->getBackgroundColor()
                    ]
                );
            }

            $calendars = GoogleCalendar::where('user_id', auth()->user()->id)->get();

            return response()->json(['result' => true, 'calendars' => $calendars], 200);
        }

        //return redirect('/google-calendar/oauth');
        return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
    }

    /**
     * Sincroniza el calendario de Google
     *
     * @method    syncGoogleCalendar
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    Response                Redirecciona a la página solicitada
     */
    public function syncGoogleCalendar()
    {
        if (session()->has('access_token') && session('access_token')) {
            $this->client->setAccessToken(session()->get('access_token'));

            //$this->client->authenticate(session('google-calendar-code'));
            $service = new Google_Service_Calendar($this->client);
            foreach ($service->calendarList->listCalendarList()->getItems() as $calendar) {
                $results = $service->events->listEvents($calendar->getId());

                $primaryCalendar = $calendar->getPrimary();
                $calendarName = ($primaryCalendar === true) ? 'Primario' : $calendar->getSummary();

                $gCalendar = GoogleCalendar::updateOrCreate(
                    ['google_id' => $calendar->getId(), 'user_id' => auth()->user()->id],
                    [
                        'name' => $calendarName,
                        'description' => $calendar->getDescription() ?? null,
                        'color' => $calendar->getBackgroundColor()
                    ]
                );

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
                    if (!empty($result->getStart()->dateTime) && Carbon::parse($result->getEnd()->dateTime) > Carbon::now()) {
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
                                'external_key' => $result->getId(),
                                'external_calendar' => 'gCalendar',
                                'eventable_type' => GoogleCalendar::class,
                                'eventable_id' => $gCalendar->id
                            ],
                            [
                                'title' => $result->getSummary(),
                                'start_at' => substr($startAt, 0, -6),
                                'end_at' => substr($endAt, 0, -6),
                                'user_id' => auth()->user()->id,
                                'category' => 'O',
                                'notes' => $result->getDescription() ?? '',
                                'place' => null,
                            ]
                        );
                    }
                }
            }

            session()->flash('message', 'Calendario sincronizado con éxito');

            return redirect()->route('events.index');
        }

        return redirect('/google-calendar/oauth');
    }

    /**
     * Desconecta la cuenta de Google Calendar con el calendario de eventos local
     *
     * @method    disconnect
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @return    JsonResponse        Json con los datos de respuesta
     */
    public function disconnect()
    {
        $calendarSetting = CalendarSetting::where(['user_id' => auth()->user()->id, 'appType' => 'gCalendar'])->first();

        if ($calendarSetting) {
            if (session()->has('access_token') && session('access_token')) {
                $this->client->setAccessToken(session()->get('access_token'));
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
                }
            }

            $calendarSetting->delete();
            session()->forget(['google-calendar-code', 'access_token']);
            session()->flash('message', 'Calendario de Google eliminado con éxito');
            return response()->json(['result' => true], 200);
        }

        return response()->json(['result' => false], 200);
    }

    /**
     * Filtrar eventos de acuerdo a calendario seleccionado
     *
     * @method    filterEvents
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request         $request    Objeto con información de la petición
     *
     * @return    JsonResponse    Json con datos de los eventos asociados a uno o mas calendarios seleccionados
     */
    public function filterEvents(Request $request)
    {
        if (count($request->selectedCalendars) > 0) {
            $calendars = GoogleCalendar::whereIn('google_id', $request->selectedCalendars)->get('id');
            $events = auth()->user()->events()->where('eventable_type', GoogleCalendar::class)
                            ->whereIn('eventable_id', $calendars)->get();
        } else {
            $events = auth()->user()->events;
        }
        return response()->json(['result' => true, 'events' => EventsResource::collection($events)], 200);
    }
}
