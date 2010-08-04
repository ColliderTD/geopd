<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

require_once("config.php");
require_once(Dao."TicketDao.php");
class TicketMod extends ModelLib
{
	public function InsTicket($Usuario)
	{
		$lPersona = sprintf(InsTicket,$Usuario);
		$this->db->ExecuteNroQuery($lPersona);
		$lResult=$this->db->Id();
		return $lResult;
	}

	public function DelTicketbyUser($Usuario)
	{
		$qTicket = sprintf(DelTicketbyUser,$Usuario);
		$lResult = $this->db->ExecuteQuery($qTicket);
	}

	public function GetTicketbyUsuario($Ticket,$Usuario)
	{
		$qTicket = sprintf(GetTicketbyUser,$Ticket,$Usuario);
		$lResult=$this->db->ExecuteQuery($qTicket);
		return $this->db->NroRows();
	}
}

?>