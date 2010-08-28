<?php
require_once("config.php");
require_once(Dao."RolDao.php");
require_once(Dto."RolDto.php");
class RolMod extends ModelLib
{
	public function GetRol($iRolId)
	{
		$qRol = sprintf(GetRol,$iRolId);
		$lResult=$this->db->ExecuteQuery($qRol);
		$object = $this->db->TableToObject("RolDTO",$lResult);
		return $object;
	}

	public function GetPaginasbyRol($iRolId)
	{
		$qPaginas = sprintf(GetPaginasbyRol,$iRolId);
		$lResult=$this->db->ExecuteQuery($qPaginas);
		return $lResult;
	}

	public function GetRoles()
	{
		$qPaginas = sprintf(GetRoles);
		$lResult=$this->db->ExecuteQuery($qPaginas);
		return $lResult;
	}
}?>