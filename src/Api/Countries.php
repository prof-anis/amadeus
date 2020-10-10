<?php
namespace Busybrain\Reloadly\Api;


class Countries extends BaseApi{

	protected const URI = 'countries';

	 public function fetch($iso = ''){
	 	return $iso == '' ? $this->get(self::URI) : $this->get(self::URI."/$iso");
	 }
}