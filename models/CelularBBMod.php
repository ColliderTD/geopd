<?php
require_once("config.php");
require_once(Dao."CelularBBDao.php");
require_once(Dto."CelularBBDto.php");

class CelularBBMod extends ModelLib
{
    	public function GetCelularID($IMEI)
	{
            $qCelularBB = sprintf(GetCelularBBByIMEI,$IMEI);
            $lResult=$this->db->ExecuteQuery($qCelularBB);
            $object = $this->db->TableToObject("CelularBBDTO",$lResult);
            return $object;
	}

        public function GetCelulares($UsuarioID)
        {
            $qCelularBBList = sprintf(GetCelularBBListByIDUsuario,$UsuarioID);
            $lResult=$this->db->ExecuteQuery($qCelularBBList);

            return $lResult;
        }
}?>