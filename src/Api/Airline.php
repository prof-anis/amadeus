<?php


namespace Busybrain\Amadeus\Api;


class Airline extends BaseApi
{
    public function getAirlineByCode()
    {
        return $this->get("/reference-data/airlines", [""])
    }
}