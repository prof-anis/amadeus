<?php

namespace Busybrain\Amadeus\Api;

/**
 * Class Account
 * @package Busybrain\Reloadly\Api
 */
class FlightSearch extends BaseApi{

    /**
     *
     */
    protected const URI = '/shopping/flight-offers';


    /**
     * @return mixed
     * @throws \Busybrain\Reloadly\Exceptions\ClientErrorException
     */
    /*
    * $data = [
    'originCodeLocation' => 'LOS',
    'destinationLocationCode' => '',
    'departureDate' => '',
    'returnDate' => '',
    'adults' =>  ,
    'childres'=>
    'infant'=> , 
    'travelClass'=>'',
    'includeAirlineCode'=>,
    'excludeAirlineCode'=>
    'nonStop'=>
    'currencyCode'=>
    'max'=>
    'maxPrice'=>

];
    */
    public function fetch(array $data){
		return $this->get(self::URI,$data);
	}
}