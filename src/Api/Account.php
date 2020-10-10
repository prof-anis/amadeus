<?php

namespace Busybrain\Reloadly\Api;

/**
 * Class Account
 * @package Busybrain\Reloadly\Api
 */
class Account extends BaseApi{

    /**
     *
     */
    protected const URI = '/accounts';


    /**
     * @return mixed
     * @throws \Busybrain\Reloadly\Exceptions\ClientErrorException
     */
    public function balance(){
		return $this->get(self::URI.'/balance');
	}
}