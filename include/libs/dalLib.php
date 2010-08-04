
<?php
require_once("config.php");
class DalLib extends PrincipalLib
{


	private $serv; //servidor de base de datos
	private $user; //usuario base de datos
	private $pass; //password de la base de datos
	private $bd;   //especificacion de base de datos
	private $NDB = "rrhh";

	private static $link;
	private static $instance = null;
	private $nroRows;

	private $nroError;
	private $error;

	private $id;

	private function __construct(){}

	private function SetClass()
	{
		$documento_xml = file_get_contents("include/libs/config.xml");
		$xml = simplexml_load_string($documento_xml);
		$NDB = $this->NDB;
	 $this->serv = $xml->$NDB->Server;
	 $this->user = $xml->$NDB->User;
	 $this->pass = $xml->$NDB->Pass;
	 $this->bd = $xml->$NDB->BD;
	}


	public function Conectar()
	{
		if(empty($this->link))
		{
			$this->SetClass();
			$this->link = @mysql_connect($this->serv,$this->user,$this->pass);// or die( mysql_error());

			if (empty($this->link))
	  { $this->nroerror = mysql_errno();
	  throw new Exception(mysql_error());
	  }

	  $db_selected = @mysql_select_db($this->bd,$this->link);

	  if (empty($db_selected))
	  {
	  	$this->nroerror = mysql_errno();
	  	throw new Exception(mysql_error());
	  }
	 }

	}

	public function ExecuteQuery($Query)
	{
		$this->Conectar();

		$result = @mysql_query($Query,$this->link);
		if (empty($result))
		{
			$this->nroError = mysql_errno($this->link);

			$this->error = mysql_error($this->link);
			echo $this->error;
			throw new Exception();
		}
		$this->nroRows = @mysql_numrows($result);
		return $result;
	}

	public function ExecuteNroQuery($Query)
	{
		$this->Conectar();
		$result = @mysql_query($Query,$this->link);
		if (empty($result))
		{
			$this->nroError = mysql_errno($this->link);
			$this->error = mysql_error($this->link);
			throw new Exception();
		}
		$this->id=mysql_insert_id($this->link);
		return mysql_affected_rows();
	}

	public function NroRows()
	{
		return $this->nroRows;
	}

	public function SetNDB($NDB)
	{
		$this->NDB = $NDB;
	}

	public function NroError()
	{
		return $this->nroError;
	}

	public function Error()
	{
		return $this->error;
	}


	public function Id()
	{
		return $this->id;
	}


	public static function singleton()
	{
		if( self::$instance == null )
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function TableToObject($Class,$DataTable)
	{
		if($row=mysql_fetch_array($DataTable,MYSQL_ASSOC))
		{   $ee= new $Class;
		foreach (array_keys($row) as $lArrayKey)
		{ $ee->{$lArrayKey}=$row["$lArrayKey"];}
		return $ee;
		}
		else
		{   return null; }
	}

	public function TableToLista($Class)
	{

	}
}

/*$clase = new DalLib();
 //$clase->Conectar();
 $clase->ExecuteQuery("Select * from Ubigeo");*/
?>

