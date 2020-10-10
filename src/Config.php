<?php


namespace Busybrain\Reloadly;
	

use Busybrain\Reloadly\Exceptions\RuntimeException;

class Config{

	protected $client_key;

	protected $secret_key;

	protected $env;

	protected const AUTH_URI = "https://auth.reloadly.com/oauth/token";

	function __construct($client_key = '',$secret_key = '',$env){
		$this->client_key = $client_key;
		$this->secret_key = $secret_key;
		$this->env = $env;

		if (!$this->client_key || !$this->secret_key){
		    throw new RuntimeException("Secret key and/or public key not set");
        }
	}


	public function getClientKey(){
		return $this->client_key;
	}

	public function getSecretKey(){
		return $this->secret_key;
	}

	public function getAuthUri(){
		return self::AUTH_URI;
	}

	public function getAudience(){
		return "https://topups-sandbox.reloadly.com";
		return $this->env == 'sandbox' ? "https://topups-sandbox.reloadly.com" : "https://topups.reloadly.com";
	}
}