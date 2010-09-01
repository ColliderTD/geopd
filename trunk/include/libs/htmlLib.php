<?php
class HtmlLib
{
	private static $instance = null;

	private function __construct() {

	}

	function printf_array($format, $arr)
	{
		return call_user_func_array('sprintf', array_merge((array)$format, $arr));
	}

	public function combo($data,$name,$value,$text,$css,$js,$selected,$default=false)
	{
		$lSelected=false;

		$lHtml='<select name="'.$name.'" class="'.$css.'" ';

		if(is_array($js))
		$lHtml = $lHtml.$js[0].'="'.$js[1].'" ';
		$lHtml = $lHtml.'>';

		if($default==true)
		{$lHtml = $lHtml . '<option value="0" selected">--SELECCIONE--</option>';
		$lSelected=true;}


		while($lRow=mysql_fetch_object($data))
		{
			$lValue = $lRow->$value;
			$lText = $lRow->$text;
			$lHtml=$lHtml.'<option value="'.$lValue.'"';

			if($lValue=$selected && $lSelected)
			{$lHtml=$lHtml.'selected';}

			$lHtml=$lHtml.' >&nbsp;'.$lText.'</option>';
		}

		$lHtml = $lHtml . '</select>';
		return $lHtml;
	}


	public function textbox($name,$css,$value,$maxchars,$js,$readonly=false)
	{
		if($readonly==true)$readonly = 'readonly="readonly"';

		$lHtml='<input type="text"'.$readonly.' id="'.$name.'" name="'.$name.'" class="'.$css.'" value="'.$value.'" maxlength="'.$maxchars.'" ';

		if(is_array($js))
		$lHtml = $lHtml.$js[0].'="'.$js[1].'" ';
		$lHtml = $lHtml.' />';

		return $lHtml;
	}

	public function textfecha($div,$name,$css,$value,$maxchars,$js)
	{
		$lHtml='<input type="text" id="'.$name.'" readonly="readonly" name="'.$name.'" class="'.$css.'" value="'.$value.'" maxlength="'.$maxchars.'" ';

		if(is_array($js))
		$lHtml = $lHtml.$js[0].'="'.$js[1].'" ';
		$lHtml = $lHtml.' />';

		$lHtml.= "<div id='".$div."' style='position:absolute;background-color:white;layer-background-color:white;z-index:5'></div></td>";

		return $lHtml;
	}

	public function pass($name,$css,$value,$maxchars)
	{
		$lHtml='<input type="password" name="'.$name.'" class="'.$css.'" value="'.$value.'" maxlength="'.$maxchars.'" />';

		return $lHtml;
	}

	public function label($name,$css,$value)
	{
		$lHtml = '<label class="'.$css.'"for="'.$name.'">'.$value.'</label>';

		return $lHtml;
	}

	public function submit($name,$css,$value,$js)
	{
		$lHtml='<input type="submit" name="'.$name.'" class="'.$css.'" value="'.$value.'" ';

		if(is_array($js))
		$lHtml = $lHtml.$js[0].'="'.$js[1].'" ';
		$lHtml = $lHtml.' />';

		return $lHtml;
	}

	public function button($name,$css,$value,$js)
	{
		$lHtml='<input type="button" name="'.$name.'" class="'.$css.'" value="'.$value.'" ';

		if(is_array($js))
		$lHtml = $lHtml.$js[0].'="'.$js[1].'" ';
		$lHtml = $lHtml.' />';

		return $lHtml;
	}

	public function imgbutton($fn,$img,$txt)
	{
		$lHtml='<A href="javascript:'.$fn.'" ';
		$lHtml = $lHtml.'><IMG height=16px width=16px border=0 src="include/images/'.$img.'"/>'.$txt.'</A>';

		return $lHtml;
	}

	public function lnkbutton($fn,$txt)
	{
		$lHtml='<A href="javascript:'.$fn.'" ';
		$lHtml = $lHtml.'>'.$txt.'</A>';

		return $lHtml;
	}


	public function hidden($name,$value)
	{
		$lHtml='<input type="hidden" name="'.$name.'" value="'.$value.'">';

		return $lHtml;
	}

	public function image($scr,$w,$h)
	{
		$lHtml='<img src="include/images/'.$scr.'" width="'.$w.'" height="'.$h.'"/>';
		return $lHtml;
	}


	public function PopUp()
	{
	return'	<div id="blanket" style="display: none;"></div>
<div id="popUpDiv" style="display: none; width: 600px; height: 250px"></div>';

	}


	public function lPopUp($div,$function,$name)
	{
	 return	'<a href="#" onclick="popup(\''.$div.'\');'.$function.'" class="lnkPrincipal">'.$name.'</a>';
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