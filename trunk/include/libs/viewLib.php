<?php
require_once("config.php");
class ViewLib
{
	function __construct()
	{
	}

	public function show($lPage, $lVars = array())
	{
		$lViewPath = ViewFol. $lPage.'View.php';


		if (file_exists($lViewPath) == false)
		{	trigger_error ('Template `' . $lViewPath . '` does not exist.', E_USER_NOTICE);
			return false;}

		if(is_array($lVars))
		{	foreach ($lVars as $lKey => $lValue)
			{$$lKey = $lValue;}
		}

		include($lViewPath);
		$lContent = ob_get_contents();
		ob_end_clean();
		$this->responde($lContent);


	}

	public function replacePage($lPage,$lVars)
	{
		$lViewPath = ViewFol.'design/'.$lPage.'.php';

		if (file_exists($lViewPath) == false)
		{	trigger_error ('Template `' . $lViewPath . '` does not exist.', E_USER_NOTICE);
			return false;}

		if(is_array($lVars))
		{	foreach ($lVars as $lKey => $lValue)
			{	$$lKey = $lValue;

                        }
		}

		include($lViewPath);
	    $lContent = ob_get_contents();
		ob_end_clean();

		$this->responde($lContent);

	}

	private function responde($lContent)
	{
	/*	$lSearch = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
		 $lReplace = array('>','<','\\1');
		 $lContent = preg_replace($lSearch, $lReplace, $lContent);
		 $lContent = str_replace("> <", "><", $lContent);
		 $lContent = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $lContent);
		ob_start();
		 ob_start("ob_gzhandler");*/
		 echo $lContent;

		//echo $sTexto;
	}

}

?>