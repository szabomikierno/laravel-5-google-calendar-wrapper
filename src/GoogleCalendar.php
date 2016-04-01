<?php

namespace Szabomikierno\GoogleCalendarLaravelWrapper;

class GoogleCalendar{

	public $client;
	public $credentials;

	function __construct($client, $credentials) {

		$this->client = $client;
		
		$this->credentials = $credentials;

	}

}