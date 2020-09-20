<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Google_Client;
use Google_Service_Calendar;

//use Google_Service_Calendar_Event;
//use Google_Service_Calendar_EventDateTime;

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
        if (session()->has('access_token') && count(session()->get('access_token')) > 0) {
            //$this->checkToken();
            $this->client->setAccessToken(session()->get('access_token')['access_token']);

            $service = new Google_Service_Calendar($this->client);
            //dd(session()->get('access_token'));
            $results = $service->events->listEvents('primary');
            //dd("entro");

            return response()->json(['result' => true, 'events' => $results->getItems()], 200);
        }

        //return response()->json(['result' => false, 'redirect' => '/google-calendar/oauth']);
        return redirect('/google-calendar/oauth');
    }

    public function oauth()
    {
        if (!isset($_GET['code'])) {
            $authUrl = $this->client->createAuthUrl();
            $filteredUrl = filter_var($authUrl, FILTER_SANITIZE_URL);
            return redirect($filteredUrl);
        }

        $this->client->authenticate($_GET['code']);
        session()->put('access_token', $this->client->getAccessToken());

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
