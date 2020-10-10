<?php

namespace Busybrain\Amadeus\Api;


use Busybrain\Amadeus\Client;
use Busybrain\Amadeus\Config;
use Busybrain\Amadeus\Exceptions\ClientErrorException;
use Busybrain\Amadeus\Http\ResponseMediator;
use Busybrain\Amadeus\Contract\ApplicationInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Class BaseApi
 * @package Busybrain\Reloadly\Api
 */
abstract  class BaseApi{

    /**
     *
     */
    protected const BASE_URI = "https://test.api.amadeus.com/v2";

    /**
     * BaseApi constructor.
     * @param ApplicationInterface $app
     */
    function __construct(ApplicationInterface $app){

		$this->client = $app->make(Client::class);
		
		 
	}

    /**
     * @param $uri
     * @param array $parameters
     * @param array $headers
     * @return mixed
     * @throws ClientErrorException
     */
    public function get($uri , array $parameters = [] , array $headers = []){

		$uri = count($parameters) > 0 ? self::BASE_URI.$uri."?".http_build_query($parameters)
                                      : self::BASE_URI.$uri;

        try{
            $response = $this->client->withToken()->get($uri,['headers'=>$headers]);
            return ResponseMediator::getContent($response);
        }
        catch (ClientException $e){
             return $e->getMessage();
           throw new ClientErrorException($e->getMessage());
        } 


	}

    /**
     * @param $uri
     * @param array $parameters
     * @param array $headers
     * @return mixed
     * @throws ClientErrorException
     */
    public function post($uri , array $parameters = [] , array $headers = []){
        $uri = self::BASE_URI.$uri;

        try{
            $response = $this->client->withToken()->post($uri,['form_params'=>$parameters,'headers'=>$headers]);
            return ResponseMediator::getContent($response);
        }
        catch (ClientException $e){
            return $e->getMessage()->errors()->details;
            //throw new ClientErrorException($e->getMessage());
        }

    }
}