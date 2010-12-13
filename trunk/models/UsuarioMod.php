<?php
require_once("config.php");
require_once(Dao."UsuarioDao.php");
require_once(Dto."UsuarioDto.php");
class UsuarioMod extends ModelLib
{
	public function GetModulosbyUsuario($sUsuario)
	{
		$qTitulos = sprintf(GetTitulosbyUsuario,$sUsuario);
		$lResult=$this->db->ExecuteQuery($qTitulos);
		return $this->db->NroRows();

	}

	public function GetPaginasbyUsuario($sUsuario)
	{
		$qPaginas = sprintf(GetPaginasbyUsuario,$sUsuario);
		$lResult=$this->db->ExecuteQuery($qPaginas);
		return $lResult;
	}

	public function GetUsuariobyLogin($sUsuario,$sContrasenia)
	{
		$qLogin = sprintf(GetUsuariobyLogin,$sUsuario,md5($sContrasenia));
		$lResult=$this->db->ExecuteQuery($qLogin);
		$object = $this->db->TableToObject("UsuarioDto",$lResult);
		return $object;
	}

	public function InsAcceso($sUsuario,$iEstado)
	{
		$sIP=getenv("REMOTE_ADDR");
		$qAcceso = sprintf(InsAcceso,$sUsuario,$sIP,$iEstado);
		$this->db->ExecuteQuery($qAcceso);
		return true;
	}

	public function InsVista($sUsuario,$Documento,$sPersona,$iEstado,$iContrato=0)
	{
		$sIP=getenv("REMOTE_ADDR");
		$qVista = sprintf(InsVista,$sUsuario,$Documento,$sPersona,$sIP,$iEstado,$iContrato);
		$this->db->ExecuteQuery($qVista);
		return true;
	}

	public function InsUsuario($sUsuario,$sNombres,$sApellidos,$iRol,$sContrasena)
	{
		$qUsuario = sprintf(InsUsuario,$sUsuario,$sNombres,$sApellidos,$iRol,$sContrasena);
		$this->db->ExecuteQuery($qUsuario);
		return true;
	}

	public function ExtUsuario($sUsuario)
	{
		$qVista = sprintf(GetUsuario,$sUsuario);
		$result = $this->db->ExecuteQuery($qVista);

		if($row=mysql_fetch_array($result,MYSQL_ASSOC))	return true;
		else return false;
	}

	public function GetUsuarios($sUsuario)
	{
		$qUsuarios = sprintf(GetUsuarios,$sUsuario);
		$lResult=$this->db->ExecuteQuery($qUsuarios);
		return $lResult;
	}

        public function GetUsuarioByID($sUserID)
	{
		$qUsuarios = sprintf(GetUsuarioByID,$sUserID);
		$lResult=$this->db->ExecuteQuery($qUsuarios);
		$object = $this->db->TableToObject("UsuarioDto",$lResult);
		return $object;
	}

}?>