<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$TitlePage;?></title>

<?
require_once("config.php");
echo lCss;
echo lJs;
echo $Ajax;
?>
</head>
<body onload="<?=$load;?>">
<form name="ampliarmapa" id="ampliar" action="" method="post">
    <div id="divResultados" style="z-index:-1">
        <div id="map" style="width:100%; height:700px" align="center"></div>
    </div>
</form>
</body>
</html>