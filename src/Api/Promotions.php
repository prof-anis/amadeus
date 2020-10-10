<?php


namespace Busybrain\Reloadly\Api;


class Promotions extends BaseApi
{
    protected const URI = "promotions";

    public function fetch($data = []){
        return $this->get(self::URI,$data);
    }

    public function fetchById($id){
        return $this->get(self::URI."/".$id);
    }

    public function fetchByCountry($country_code){
        return $this->get(self::URI."/country-codes/".$country_code);

    }

    public function fetchByOperator($operator){
        return $this->get(self::URI."/operators/".$operator);

    }
}