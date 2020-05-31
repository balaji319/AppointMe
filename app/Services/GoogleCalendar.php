<?php
namespace App\Services;

use Google_Client; 
use Google_Service_Calendar;
use Google_Service_Gmail;

class GoogleCalendar 
{
	public static function getClient()
	{
		$client = new Google_Client();
		$client->setApplicationName(config('app.name'));
		//  $client->setScopes(Google_Service_Directory::CALENDAR_READONLY);
		$client->setAuthConfig(storage_path('keys/client_secret.json'));
		$client->setAccessType('offline');
		$client->setIncludeGrantedScopes(true);
		$client->addScope(Google_Service_Calendar::CALENDAR);
		$client->addScope(Google_Service_Gmail::GMAIL_READONLY);

	   return $client;
	}
 
	/**
	 * Returns an authorized API client.
	 * @return Google_Client the authorized client object
	 */
	public static function oauth()
	{
		$client = new Google_Client();
		$client->setApplicationName(config('app.name'));

		$client->setAuthConfig(storage_path('keys/client_secret.json'));
		$client->setAccessType('offline');
		$client->setIncludeGrantedScopes(true);
		$client->addScope(Google_Service_Calendar::CALENDAR);

		// Load previously authorized credentials from a file.
		$credentialsPath = storage_path('keys/client_secret_generated.json');
		if (!file_exists($credentialsPath)) {
			return false;
		}

		$accessToken = json_decode(file_get_contents($credentialsPath), true);
		$client->setAccessToken($accessToken);

		// Refresh the token if it's expired.
		if ($client->isAccessTokenExpired()) {
			$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
		}

		return $client;
	 }



	/**
	 * Returns all google client calender
	 * @return Google_Client the authorized client object
	 */				
	public static function  getResources($client)
	{
		$calEvents['events']=[]; $calEvents['time']=[];
		function decodeBody($body) {
		    $rawData = $body;
		    $sanitizedData = strtr($rawData,'-_', '+/');
		    $decodedMessage = base64_decode($sanitizedData);
		    if(!$decodedMessage){
		        $decodedMessage = FALSE;
		    }
		    return $decodedMessage;
		}

		$service = new Google_Service_Calendar($client);

		// On the user's calenda print the next 10 events .
		$calendarId = 'primary';
		$optParams = array(
		  'maxResults' => 10,
		  'orderBy' => 'startTime',
		  'singleEvents' => true,
		  'timeMin' => date('c'),
		);


		$results = $service->events->listEvents($calendarId, $optParams);
		$events = $results->getItems();

		if (empty($events)) {
		    // print "No upcoming events found.\n";
		     return response()->json(['msg' => 'No upcoming events found', 'events' => $calEvents]);
		} else {
		    // print "Upcoming events:\n";
		    foreach ($events as $event) {
		        $start = $event->start->dateTime;
		        if (empty($start)) {
		            $start = $event->start->date;
		        }
		        // printf("%s (%s)\n", $event->getSummary(), $start);
		        array_push($calEvents['events'], $event->getSummary());
		        array_push($calEvents['time'], $start);
		        
		    }

		    return response()->json(['msg' => 'Upcoming events', 'events' => $calEvents]);
		}
	}
}