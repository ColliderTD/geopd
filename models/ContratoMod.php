<?php
require_once("config.php");
require_once(Dao."ContratoDao.php");
require_once(Dto."ContratoDto.php");
class ContratoMod extends ModelLib
{
	public function GetContrato($iUsuarioId)
	{
		$qContrato = sprintf(GetContratobyUsuario,$iUsuarioId);
		$lResult=$this->db->ExecuteQuery($qContrato);
		$object = $this->db->TableToObject("ContratoDTO",$lResult);
		return $object;
	}

	public function UpdVistas($iContratoId)
	{
		$qContrato = sprintf(UpdVistas,$iContratoId);
		$this->db->ExecuteQuery($qContrato);
		return true;
	}

	public function GetContratos($iUsuarioId)
	{
		$qContrato = sprintf(GetContratosbyUsuario,$iUsuarioId);
		$lResult=$this->db->ExecuteQuery($qContrato);
		return $lResult;
	}

	public function InsContrato($iUsuarioID,$sFecIni,$sFecFin,$iVisitas)
	{
		$qContrato = sprintf(InsContrato,$iUsuarioID,$sFecIni,$sFecFin,$iVisitas,$iVisitas);
		$lResult=$this->db->ExecuteQuery($qContrato);

		return true;
	}

}?>