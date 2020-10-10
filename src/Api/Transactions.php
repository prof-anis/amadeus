<?php

namespace Busybrain\Reloadly\Api;

class Transactions extends BaseApi{

	protected const URI = 'topups/reports/transactions';

	public function fetch($id=null){
		return $id == null
                    ? $this->get(self::URI)
                    : $this->get(self::URI."/".$id);
	}

}