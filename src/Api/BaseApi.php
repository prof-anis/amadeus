<?php

namespace Busybrain\Reloadly\Api;


use Busybrain\Reloadly\Client;
use Busybrain\Reloadly\Config;
use Busybrain\Reloadly\Exceptions\ClientErrorException;
use Busybrain\Reloadly\Http\ResponseMediator;
use Busybrain\Reloadly\Contract\ApplicationInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Class BaseApi
 * @package Busybrain\Reloadly\Api
 */
abstract  class BaseApi{

    /**
     *
     */
    protected const BASE_URI = "https://topups-sandbox.reloadly.com/";

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
            $response = $this->client->withToken()->post($uri,['json'=>$parameters,'headers'=>$headers]);
            return ResponseMediator::getContent($response);
        }
        catch (ClientException $e){
            throw new ClientErrorException($e->getMessage());
        }

    }
}