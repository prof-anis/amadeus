<?php


namespace Busybrain\Amadeus\Http;

use Illuminate\Collection;
use GuzzleHttp\Psr7\Response;

/**
 * Class ResponseMediator
 * @package Busybrain\Reloadly\Http
 */
class ResponseMediator{


    /**
     * @param $response
     * @return mixed
     */
    public static function getContent($response){
		$body = $response->getBody()->__toString();

        $content = json_decode($body, true);

            if (JSON_ERROR_NONE === json_last_error()) {
                return static::parseContent($content);
            }
        

        return $body;
	}

    /**
     * @param $content
     * @return mixed
     */
    protected static function parseContent($content)
    {
        if (is_array($content) && isset($content['data'])) {
            $data = $content['data'];
            if (isset($data[0])) {
                return Collection::make($data);
            }

            return $data;
        }

        return $content;
    }

    /**
     * Retrieves a header in a Response.
     *
     * @param ResponseInterface $response
     * @param                   $name
     *
     * @return mixed
     */
    public static function getHeader(Response $response, $name)
    {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }

    /**
     * @param Response $response
     * @return array
     */
    public static function getHeaders(Response $response){
    	return $response->getHeaders();
    }
}