<?php
namespace Busybrain\Amadeus;

use Busybrain\Amadeus\Http\ResponseMediator;
use GuzzleHttp\Client as GuzzleClient;
use Busybrain\Amadeus\Contract\Config;
use Busybrain\Amadeus\Contract\ApplicationInterface;

/**
 * Class Client
 * @package Busybrain\Reloadly
 */
class Client{

    /**
     * @var array
     */
    protected $headers = [];

    
    protected $client;

    /**
     * Client constructor.
     * @param ApplicationInterface $app
     */
    function __construct(ApplicationInterface $app){

		$this->config = $app->make(Config::class);
		 
	
	}

    /**
     * @return GuzzleClient
     */
    protected function getClient(){
		 
		$this->client = new GuzzleClient(['headers'=> $this->headers]);
		return $this->client;
	}

    /**
     * @param $type
     * @param $value
     * @return $this
     */
    public function addHeader($type, $value){
		$this->headers[$type]  = [$value];
		return $this;
	}

    /**
     * @return $this
     */
    public function withMainHeaders(){
		$this->addHeader('Content-Type','application/json');
		$this->addHeader("Accept", "application/json, application/vnd.amadeus+json");
		return $this;
	}

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAuthToken(){
		
		
		$response =  $this->withMainHeaders()->getClient()->post($this->config->getAuthUri(),[
					'form_params'=>[
					 
						'client_id'=> $this->config->getClientKey(),
						'client_secret' => $this->config->getSecretKey(),
						'grant_type' => "client_credentials"
						]
					]);


		return ResponseMediator::getContent($response)['access_token'];
	}

    /**
     * @return GuzzleClient
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function withToken()
    {
		$this->headers = [];
        
		$this->addHeader('Authorization', "Bearer ".$this->getAuthToken());
		return $this->getClient();
	}



	
}
