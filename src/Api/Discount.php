<?php


namespace Busybrain\Reloadly\Api;


class Discount extends BaseApi
{
    protected const URI = "operators";

    public function fetch(array $parameters = [] ){
        return $this->get(self::URI."/commissions",$parameters);

    }

    public function fetchById($id){
        return   $this->get(self::URI."/operators/".$id."/commissions");
    }
}