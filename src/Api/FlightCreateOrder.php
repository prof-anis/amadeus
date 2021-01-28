<?php


namespace Busybrain\Amadeus\Api;


class FlightCreateOrder extends BaseApi
{
    public function create(array $data)
    {
        return $this->postWithBody("/booking/flight-orders", $data);
    }
}