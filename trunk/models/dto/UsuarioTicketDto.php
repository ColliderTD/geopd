<?php

/**
 * @author Carlos
 * @copyright 2009
 */

class UsuarioTicketDTO
{
	var $Login;
	var $LastTime;
	var $Ticket;

	function __construct($vLogin, $vTicket)
	{
	 $this->Login = $vLogin;
	 $this->Ticket = $vTicket;
	}

	public function getLogin()
	{
	 return $this->Login;
	}

	public function getTicket()
	{
		return $this->Ticket;
	}



}

?>