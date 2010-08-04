<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

require_once("config.php");


class ControllerLib extends PrincipalLib
{
	protected $lView;

	function __construct()
	{
		$this->lView = new ViewLib();

	}

}

?>