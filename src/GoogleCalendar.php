<?php

namespace Szabomikierno\GoogleCalendarLaravelWrapper;

class GoogleCalendar{

	private $gClient;

	private $gCalendar;
	
	private $credentials;

	private $accessToken;

	private $redirectUri;

	private $token;

	function __construct($gClient, $credentials) {

		$this->gClient = $gClient;

		$this->credentials = $credentials;

		$this->init();

	}

	private function init() {

		$this->gClient->setApplicationName($this->credentials['application_name']);
		$this->gClient->setScopes(implode(' ', array(\Google_Service_Calendar::CALENDAR_READONLY)));
		$this->gClient->setAuthConfigFile($this->credentials['client_secret_path']);
		$this->gClient->setAccessType('offline');

	}

	public function setToken($token) {
		$this->token = $token;
		return $this;
	}

	public function authenticate($authCode = '') {

		if($authCode != '') {

		    $this->token = $this->gClient->authenticate($authCode);

		} else if(!isset($this->token)) {
			dd('Unauthorized request');
		}

		$this->gClient->setAccessToken($this->token);
		
		if ($this->gClient->isAccessTokenExpired()) {
			$this->gClient->refreshToken($this->gClient->getRefreshToken());
			$this->token = $this->gClient->getAccessToken();
		}

		$this->gCalendar = new \Google_Service_Calendar($this->gClient);
		
		return $this;
	}

	public function getToken() {
		return $this->accessToken;
	}

	public function getAuthUrl() {

		if(!isset($this->redirectUri)){
			dd("You must set a callback URL");
		}

		$this->gClient->setRedirectUri($this->redirectUri);
		
		return filter_var($this->gClient->createAuthUrl(), FILTER_SANITIZE_URL);
	}

	public function getEvents($calendarId = 'primary', $maxResults = 10, $q = '') {
		if(!isset($this->gCalendar)){
			dd("Unauthorized request");
		}
		$optParams = array(
		  'maxResults' => $maxResults,
		  'orderBy' => 'startTime',
		  'singleEvents' => TRUE,
		  'timeMin' => date('c'),
		  'q' => $q
		);

		$results = $this->gCalendar->events->listEvents($calendarId, $optParams);

		return $results;		
	}

	public function setRedirectUri($redirectUri) {
		$this->redirectUri = $redirectUri;
		return $this;
	}
}