<?php

namespace Busybrain\Reloadly\Api;

class Operators extends BaseApi{

	protected const URI = "operators";

	public function fetch($options = []){
		return $this->get(self::URI,$options);

	}

	public function fetchById($id,$options = []){
        return $this->get(self::URI."/$id",$options);
    }

    public function fetchByIso($iso,$options = []){
	    return $this->get(self::URI."/countries/".$iso,$options);
    }

    public function fetchByPhone($phone,$country_iso){
	    return $this->get(self::URI."/auto-detect/phone/".$phone."/countries/".$country_iso);
    }
}