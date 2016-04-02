<?php

namespace Szabomikierno\GoogleCalendarLaravelWrapper;

class GoogleCalendar{

	private $gClient;

	private $gCalendar;
	
	private $credentials;

	public $redirectUri;

	public $token;

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

	public function authenticate($authCode = '') {
		$token = $this->gClient->authenticate($authCode);

		return $this->sign($token);
	}

	public function sign($token) {

		$this->gClient->setAccessToken($token);
		
		if ($this->gClient->isAccessTokenExpired()) {
			$this->gClient->refreshToken($this->gClient->getRefreshToken());
		}

		$this->gCalendar = new \Google_Service_Calendar($this->gClient);
		
		return $this->gCalendar;

	}

	public function getAuthUrl() {

		if(!isset($this->redirectUri)){
			dd("You must set a callback URL");
		}

		$this->gClient->setRedirectUri($this->redirectUri);
		
		return filter_var($this->gClient->createAuthUrl(), FILTER_SANITIZE_URL);
	}

	public function setRedirectUri($redirectUri) {
		$this->redirectUri = $redirectUri;
		return $this;
	}
}