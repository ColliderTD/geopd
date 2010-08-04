<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

require_once("config.php");
require_once(Dao."BDDao.php");
class BDMod extends ModelLib
{
	public function GetMesReporte()
	{
		$qReporte = GetMesReporte;
		$lResult = $this->db->ExecuteQuery($qReporte);
		return $lResult;
	}

}
