<?php

/**
 * @author Carlos
 * @copyright 2009
 */

require_once("config.php");
require_once(ModFol."TicketMod.php");
require_once(Dto."UsuarioTicketDto.php");


class TicketCon extends ControllerLib
{

	private static $instance=null;

	public static function InsUsuario($iUsuario)
	{
		$lTicket = new TicketMod();
		$lTicket->DelTicketbyUser($iUsuario);
		$iTicketId= $lTicket->InsTicket($sUsuario);
		$oUsuaTick =  new UsuarioTicketDTO($sUsuario,$iTicketId);
		$_SESSION['objLogin']=serialize($oUsuaTick);
	}

	public static function Valida()
	{
		if($_SESSION["objUserTicket"]!=NULL)
		{
			$oUsuaTick=unserialize($_SESSION["objUserTicket"]);
			$sUsuario=$oUsuaTick->GetLogin();
			$sTicketId=$oUsuaTick->getTicket();

			$oTicket = new TicketMod();

			if($oTicket->GetTicketbyUsuario($sTicketId,$sUsuario)>0)
			{	return true;}
			else
			{ header("Location:index.php?Page=Mensaje&Codigo=1");}
		}
		else
		{ header("Location:index.php");}
	}

	public static function singleton()
	{
		if( self::$instance == null )
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

}

?>