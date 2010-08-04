<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

require_once("csDef.php");




class DataGrid
{
	var $lCabecera=null;
	var $lCampos=null;
	var $lTr=null;
	var $Class="DataGrid";
	var $leTd=null;
	private $cTr='onMouseOver="setPointer(this,\'%s\');" onMouseOut="setPointer(this,\'#FFFFFF\');"';
	var $bPage=false;
	var $Page=0;
	var $cPage=10;
	var $data=null;
    var $pName=null;
    private $construido=false;
    var $lOrdenar=null;
    var $Campo=null;
	var $Orden=null;

	public function __construct($data,$color='#FFFF75',$class='DataGrid') {
		$this->ResArr($data);

		$this->cTr=sprintf($this->cTr,$color);
		$this->Class=$class;
	}

	function printf_array($format, $arr)
	{return call_user_func_array('sprintf', array_merge((array)$format, $arr));	}

	public function RowArr($lArr,$dtRow)
	{	$aTr=null;
		foreach ($lArr as &$lValue)
		{$aTr[]=$dtRow[$lValue];}
		return  $aTr;
	}

	public function ResArr($result)
	{  	$tmp_array=array();
	    $return_array=array();
	    while ($obj =  mysql_fetch_object($result)) {
		  foreach($obj as $key => $value) {
			$tmp_array[$key]=$value;
		  }
		$return_array[]=$tmp_array;
		unset($tmp_array);
	     }
	   $this->data=$return_array;
	   unset($return_array);
    }

	function ordenar() {
	  //usort($this->data, create_function('$item1, $item2', 'return $item1[\'' . $this->Campo. '\'] ' . ($this->Orden === 'ASC' ? '>' : '<') . ' $item2[\'' . $this->Campo. '\'];'));
	  usort($this->data, create_function('$item1, $item2', 'return strtoupper($item1[\'' . $this->Campo. '\']) ' . ($this->Orden === 'ASC' ? '>' : '<') . ' strtoupper($item2[\'' . $this->Campo. '\']);'));
	   $_SESSION[$this->pName]=serialize($this);
	}


	public function Imprimir()
	{
	 $lHtml='<table class="'.$this->Class.'" width="100%"><thead><tr class="linColor"><td colspan="'.count($this->lCabecera).'" ></td></tr><tr>';
 	 $tamdata=sizeof($this->data);
 	 $cabecera=sizeof($this->lCabecera);
 	 $j=0;
	 foreach ($this->lCabecera as &$lTh)
	 {
	  if(isset($this->lOrdenar[$j]))
	  {
	  if($this->Campo==$this->lOrdenar[$j] && $this->Orden=='ASC')$orden='DESC'; else $orden='ASC';
	   $ordenar=' style="cursor:pointer;" onclick="aOrdenar(\''.$this->pName.'\',\''.$this->lOrdenar[$j].'\',\''.$orden.'\')"';

	  }
      else  $ordenar="";
	  $lHtml.='<th'.$ordenar.' width="'.$lTh[0].'">'.$lTh[1].'</th>';
	  $j++;
	 }

	 $lHtml.='</tr><tr class="linColor"><td colspan="'.$cabecera.'" ></td></tr></thead>';

	 $inicio=0;$fin=$tamdata;

	 if($this->bPage) {$inicio=$this->Page*$this->cPage;$fin=($this->Page+1)*$this->cPage;}



	for($i=0;$i<$inicio;$i++)
	{$dtRow=next($this->data);}

	 for($i=$inicio;$i<$fin;$i++)
	 {
	  if($dtRow=current($this->data))
	  {
	 	if(is_array($this->lTr))$tr=$this->printf_array(constant($this->lTr[0]),$this->RowArr($this->lTr[1],$dtRow));
	 	else $tr='';


	 	 $lHtml.="<tr ".$this->cTr." ".$tr." >";
	 	 for($c=0,$tamc=sizeof($this->lCampos);$c<$tamc;$c++)
	 	 {  $lTd=$this->lCampos[$c];$nCampo=$lTd[1];
	 	    if(isset($this->leTd[$c]))$aling=$this->leTd[$c];else $aling="";
	 	    $lHtml.='<td align="'.$aling.'" > ';
	 	    if($lTd[0]=='d') $lHtml.=htmlentities($dtRow[$nCampo]);
	 	    else if($lTd[0]=='m') $lHtml.= number_format($dtRow[$nCampo],2);
	 	    else
	 	    if($lTd[0]=='l')$lHtml.=$this->printf_array($lTd[1],$this->RowArr($lTd[2],$dtRow));
	 	    else $lHtml.=$lTd[1];

	 	    $lHtml.='</td>';
	 	 }
	 	 $lHtml.='</tr>';
		  $lHtml.='<tr class="linColor"><td colspan="'.$cabecera.'" ></td></tr>';
	  }
			$dtRow=next($this->data);
	 }


	 if($this->bPage==true)
	 {
	 	$lHtml.='<tr ><td colspan="'.$cabecera.'" align="rigth" class="lnkPrincipal">';

	 	$minimo=(floor($this->Page/$this->cPage)*$this->cPage);
		$maximo=((floor($this->Page/$this->cPage)+1)*$this->cPage);
		$tamanio=floor($tamdata/$this->cPage)- (floor($this->Page/$this->cPage)*$this->cPage)+1;


	 	if($this->Page>=$this->cPage)$lHtml.='<a class="lnkPrincipal" href="javascript:aPaginacion(\''.($minimo-1).'\',\''.$this->pName.'\') ">Anterior</a> ';
		if($maximo>$this->Page && $tamanio>$this->cPage)$siguiente =' <a class="lnkPrincipal" href="javascript:aPaginacion(\''.($maximo).'\',\''.$this->pName.'\') ">Siguiente</a>';

		if($tamanio>=$this->cPage) $tamanio=$this->cPage;

	 	for($p=$minimo;$p<($minimo+$tamanio);$p++)
	 	{if($p==$this->Page){ $lHtml.=($p+1).' ';}
	     else{$lHtml.='<a class="lnkPrincipal" href="javascript:aPaginacion(\''.($p).'\',\''.$this->pName.'\') ">'.($p+1).'</a> ';}
	    }
		$lHtml.=$siguiente."</td></tr >";
	 }

	 $lHtml.='</table>';

		if(!$this->construido && ($this->bPage || $this->lOrdenar!=null))
		{   $this->construido=true;
			$_SESSION[$this->pName]=serialize($this);
		}

	 return $lHtml;
	}
}

?>