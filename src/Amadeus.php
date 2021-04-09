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

    /**
     * @param $method
     * @param array $args
     * @return mixed|object
     * @throws Exceptions\BadMethodCallException
     */
    function __call($method, array $args)
    {
		return $this->app->makeApi($method);
	}
}

?>
