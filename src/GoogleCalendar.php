<?php

namespace Szabomikierno\GoogleCalendarLaravelWrapper;

use Storage;

class GoogleCalendar{

	private $gClient;
	
	private $credentials;

	private $scope;

	private $redirectUri;

	function __construct($gClient, $credentials) {

		$this->gClient = $gClient;

		$this->credentials = $credentials;

		$this->scope = implode(' ', array(\Google_Service_Calendar::CALENDAR_READONLY));

		$this->init()->getClient();
	}

	private function init() {

		$this->gClient->setApplicationName($this->credentials['application_name']);
		$this->gClient->setScopes($this->scope);
		$this->gClient->setAuthConfigFile(storage_path('app/client_secret.json'));
		$this->gClient->setAccessType('offline');

		return $this;
	}

	public function setRedirectUri($redirectUri) {
		$this->gClient->setRedirectUri($redirectUri);
		return $this;
	}

	public function getAuthUrl() {
		return $this->gClient->createAuthUrl();
	}

	public function getClient(){
		return $this->gClient;
	}

}