<?php
require_once("config.php");
abstract class ModelLib extends PrincipalLib
{
	protected $db;

	public function __construct()
	{
		$this->db = DalLib::singleton();
	}
}

?>