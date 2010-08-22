<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

session_start();
require_once("include/libs/principalLib.php");
require_once("include/libs/controllerLib.php");
require_once("include/libs/viewLib.php");
require_once("include/libs/modelLib.php");
require_once("include/libs/htmlLib.php");
require_once("include/libs/dalLib.php");
require_once("include/libs/ajaxLib.php");
require_once("include/libs/dgLib.php");
//require_once("controllers/TicketCon.php");

define('ConFol','controllers/');
define('ModFol','models/');
define('ViewFol', 'views/');
define('Dao', 'dao/');
define('Dto','models/dto/');
define('Res','include/resource/');
define('lCss',
'<link href="'.Res.'quest.css" rel="stylesheet" type="text/css"/>
<link href="'.Res.'menu.css" rel="stylesheet" type="text/css"/>
<link href="'.Res.'calendar.css" rel="stylesheet" type="text/css"/>');
define('lJs',
'<script src="'.Res.'quest.js"></script>
<script src="'.Res.'calendar.js"></script>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxTPZYElJSBeBUeMSX5xXgq6lLjHthSAk20WnZ_iuuzhMt60X_ukms-AUg" type="text/javascript"></script>
');
?>