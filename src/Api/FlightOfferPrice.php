<?php


namespace Busybrain\Amadeus\Api;


class FlightOfferPrice extends BaseApi
{
    public function search($data = [])
    {
        return $this->postWithBody("/shopping/flight-offers/pricing", $data);
    }
}