<?php
require_once("csDef.php");
class AjaxLib
{
	protected $lFunciones;

	public function __construct()
	{
	}

	function printf_array($format, $arr)
	{
		return call_user_func_array('sprintf', array_merge((array)$format, $arr));
	}

	public function AgrJsPage($Tipo,$Valores=null)
	{
		$funcion = constant($Tipo);
		if($Valores!=null)
		{
			$funcion= $this->printf_array($funcion, $Valores);
		}

		$this->lFunciones[count($this->lFunciones)]=$funcion;
	}


	private function Principal()
	{
		define("BodyAjax",'function GetXmlHttpObject()
						  {var xmlHttp=null;
							try
 							{xmlHttp=new XMLHttpRequest();}
							catch (e)
 							{try
  							  {xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
 							  catch (e)
  							  {xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
 						    }
						  return xmlHttp;}');
		return BodyAjax;
	}

	private function TipoRes($Tipe,$Funcion)
	{
		$cadena ="if (tipe==1)
	{document.getElementById(div).".$Tipe."=xmlHttp.responseText;}

	if(tipe==2)
	{	var respuesta = xmlHttp.responseText.toString();
		var cadenas = respuesta.split(';');
		var validacion=trim(cadenas[0]);
		if(validacion=='true') {g".$Funcion."();}
        document.getElementById(div).".$Tipe."=cadenas[1];
    }";
		return $cadena;
	}

	private function AgrPadFuncion($Tipe,$Funcion)
	{
		$cadena = ' function stateChanged(div,load,tipe){
	if (xmlHttp.readyState==1 && load!="blanco")
		{ document.getElementById(div).'.$Tipe.'=load;} '.

	'if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
          '.$this->TipoRes($Tipe,$Funcion).'}}';

		return $cadena;
	}

	public function AgrFuncion($Page,$Funcion,$Valores,$Div=null,$Tipe,$Metodo,$tLoad,$tRes)
	{


		$this->lFunciones[count($this->lFunciones)]=$this->AgrPadFuncion($Tipe,$Funcion);

		$lFuncion="";
		$lFuncion = $lFuncion."function " . $Funcion. '(';
		$lAux=false;
		if(is_array($Valores))
		{foreach ($Valores as &$lValue)
		{ $lFuncion= $lFuncion.$lValue.','; }
		$lFuncion=substr($lFuncion,0,strlen($lFuncion)-1);
		}

		if($Div==null){$lFuncion.=",vDiv";}
		$lFuncion= $lFuncion.')
    	 {xmlHttp=GetXmlHttpObject();
		  if (xmlHttp==null){alert ("Browser does not support HTTP Request");return;}';

		$lFuncion =$lFuncion. 'var url ="'.$Page.'";';
		if(is_array($Valores))
		{if(strtoupper($Metodo)=="GET")
		{foreach ($Valores as &$lValue)
		{$lFuncion= $lFuncion.'url=url+"&'.$lValue.'="+'.$lValue.';';}
		}
		else
		{ $lFuncion= $lFuncion.'var Formulario = document.getElementById("'.$Valores[0].'");
         	var longitudFormulario = Formulario.elements.length;
         	var cadenaFormulario = "";
         	var sepCampos="";

         	for (var i=0; i <= Formulario.elements.length-1;i++) {
         	cadenaFormulario += sepCampos+Formulario.elements[i].name+"="+encodeURI(Formulario.elements[i].value);
         	sepCampos="&";}';
		}
		}

		if($Div==null)$lFuncion.="var div=vDiv;";else $lFuncion.= 'var div ="'.$Div.'";';

		$lFuncion.='var tipe="'.$tRes.'"; var load="'.constant($tLoad).'";
		                     xmlHttp.onreadystatechange=function(){stateChanged(div,load,tipe); };
							 xmlHttp.open("'.$Metodo.'",url,true);
							 xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");';

		if(strtoupper($Metodo)=="GET")
		{ $lFuncion=$lFuncion.'xmlHttp.send(null);}';		 }
		else
		{$lFuncion=$lFuncion.'xmlHttp.send(cadenaFormulario);}';}

		$this->lFunciones[count($this->lFunciones)]=$lFuncion;
	}

	public function ImprimirJs()
	{
		$lReturn='<script language="JavaScript">';
		if(is_array($this->lFunciones))
		{ foreach ($this->lFunciones as &$lValue)
		{$lReturn=$lReturn.$lValue;}
		}

		$lReturn=$lReturn.$this->Principal().'</script>';

		return $lReturn;
	}
}?>