<?php

namespace Busybrain\Amadeus;

class Amadeus{

    /**
     * @var App
     */
    protected $app;

    
    function __construct($client_id, $client_secret, $env='sandbox')
    {

		$this->app = new App($client_id,$client_secret,$env);

	}

    
    function __call($method, array $args)
    {
		return $this->app->makeApi($method);
    }
}

?>
