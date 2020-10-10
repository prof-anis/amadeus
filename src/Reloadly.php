<?php

namespace Busybrain\Reloadly;

class Reloadly{

    /**
     * @var App
     */
    protected $app;

    /**
     * Reloadly constructor.
     * @param $client_id
     * @param $client_secret
     * @param string $env
     */
    function __construct($client_id, $client_secret, $env='sandbox'){

		$this->app = new App($client_id,$client_secret,$env);

	}

    /**
     * @param $method
     * @param array $args
     * @return mixed|object
     * @throws Exceptions\BadMethodCallException
     */
    function __call($method, array $args){
		return $this->app->makeApi($method);
	}
}

?>