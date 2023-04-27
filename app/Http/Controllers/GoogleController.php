<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;
use Illuminate\Http\RedirectResponse;
use DateTime;
use Exception;
use Google\Service\Calendar\Event;
use DateTimeZone;

class GoogleController extends Controller
{
    public function index () {
        $client = new GoogleClient();
        $client->setAccessType('offline');
        $client->setScopes([
            GoogleCalendar::CALENDAR,
        ]);
    
        // You will need to replace the path with the location of your API key JSON file.
        $client->setAuthConfig(config_path("client_secret.json"));
        
        $authUrl = $client->createAuthUrl();
    
        return new RedirectResponse($authUrl);
    }

    public function redirct (Request $request) {
        $client = new GoogleClient();
        $client->setAuthConfig(config_path("client_secret.json"));
        $client->setAccessType('offline');
    
        $token = $request->query('code');
    
        $accessToken = $client->fetchAccessTokenWithAuthCode($token);
        $client->setAccessToken($accessToken);
    
        // Store the access token in the session or database for future use.
        session(['access_token' => $accessToken]);
    
        return new RedirectResponse('/event');
    }

    public function eventpost (Request $request) {
        try {

            $summary = $request->input('summary');
            $location = $request->input('location');
            $description = $request->input('description');
            $start = $request->input('start');
            $end = $request->input('end');


            $client = new GoogleClient();
            $client->setAuthConfig(config_path("client_secret.json"));
    
            $accessToken = session('access_token');
            
            $client->setAccessToken($accessToken);
    
            $calendar = new GoogleCalendar($client);
    
            $event = new Event([
                'summary' => $summary,
                'location' => $location,
                'description' => $description,
                'start' => [
                    $datestart = new DateTime($request->input('start'), new DateTimeZone('Asia/Kolkata')),
                    $start = $datestart->format(DateTime::RFC3339),
                    'dateTime' => ($start),
                    'timeZone' => new DateTimeZone('Asia/Kolkata'),
                ],
                'end' => [
                    $dateend = new DateTime($request->input('end'), new DateTimeZone('Asia/Kolkata')),
                    $end = $dateend->format(DateTime::RFC3339),
                    'dateTime' => ($end),
                    'timeZone' => new DateTimeZone('Asia/Kolkata'),
                ],
                'reminders' => [
                    'useDefault' => true,
                ],
            ]);
    
            $calendar->events->insert('primary', $event);
    
            $calendarUrl = 'https://calendar.google.com/calendar/u/0/r/day';
    
            return new RedirectResponse($calendarUrl);
        } catch (Exception $e) {
            logger($e->getMessage());
            return response($e);
        }
    }
}
