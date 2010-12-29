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

        public function GetCelulaByrID($CelID)
	{
            $qCelularBB = sprintf(GetCelularBBByID,$CelID);
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

        public function GetCelularesAll()
        {
            $qCelularBBList = sprintf(GetCelularBBB);
            $lResult=$this->db->ExecuteQuery($qCelularBBList);

            return $lResult;
        }

        public function InsCelularBB($iIDUsuario,$sNombres,$sApellidos,$sIMEI,$sNumero)
	{
		$qCelularBB = sprintf(InsCelularBB,$sNombres,$sApellidos,$sIMEI,$sNumero);
		$this->db->ExecuteNroQuery($qCelularBB);

                $iCelID = $this->db->Id();

                if($iCelID > 0)
                {
                    $qCelUser = sprintf(InsCelUsuario,$iIDUsuario,$iCelID);
                    $this->db->ExecuteQuery($qCelUser);
                    return true;
                }
                else
                {
                    return false;
                }
	}
}?>