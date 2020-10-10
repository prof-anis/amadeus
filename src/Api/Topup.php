<?php


namespace Busybrain\Reloadly\Api;


class Topup extends BaseApi
{
    protected const URI = "topups";

    public function send(array $data){
        return $this->post(self::URI,$data);
    }
}