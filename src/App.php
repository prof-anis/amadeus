<?php

namespace Busybrain\Amadeus;

use Busybrain\Amadeus\Contract\ApplicationInterface;
use Busybrain\Amadeus\Config as ReloadlyConfig;
use Busybrain\Amadeus\Client;
use Illuminate\Container\Container;
use Busybrain\Amadeus\Exceptions\BadMethodCallException;
use Busybrain\Amadeus\Contract\Config;


class App extends Container implements ApplicationInterface{

    /**
     * @var string
     */
    protected $bindPath = __DIR__.'/config/bindings.php';

    /**
     * @var
     */
    protected $bindings;

    /**
     * @var
     */
    public $client_key;

    /**
     * @var
     */
    public $secret_key;

    /**
     * @var mixed|string
     */
    public $env;

    
    function __construct($client_key, $secret_key, $env = 'sandbox'){
		$this->client_key = $client_key;
		$this->secret_key = $secret_key;
		$this->env = $env;
		$this
			->vendorBindings()
			->loadApi()
			->bindApi();
	}


    /**
     * @return $this
     */
    protected function loadApi(){
		$this->bindings = require($this->bindPath);
		return $this;
	}

    /**
     *
     */
    protected function bindApi(){
		foreach ($this->bindings as $reference => $implementation) {
			$this->bind($reference,function($app) use ($implementation){
				return new $implementation($this);
			});
		}
	}


    /**
     * @return $this
     */
    protected function vendorBindings(){

		$this->instance(ApplicationInterface::class,$this);
		$config = new ReloadlyConfig($this->client_key,$this->secret_key,$this->env);
		$this->instance(Config::class,$config);

		$this->bind(Client::class,function($app)
        {
			 return new Client($app);
		});
		
		
		return $this;
	}

    /**
     * @param $api
     * @return mixed|object
     * @throws BadMethodCallException
     */
    public function makeApi($api){
		try{
			return	$this->make($api);
		}
		catch(\Illuminate\Contracts\Container\BindingResolutionException $e){

			throw new BadMethodCallException("the $api api does not exist");
		}
		
	}
}


?>
