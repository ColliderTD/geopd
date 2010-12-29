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
<body>
<form name="imprimir" id="ampliar" action="" method="post">
    <table width="70%" class="tblBusqueda">
	<tr class="linEspacioC">
		<td colspan="4"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="6">Reporte de Ubicaciones</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="6"></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Usuario: </td>
		<td><?=$usuario;?></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Persona Ubicada: </td>
		<td><?=$persona;?></td>
                <td>Celular: </td>
		<td><?=$celular;?></td>
                <td>IMEI: </td>
		<td><?=$imei;?></td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="6"></td>
	</tr>
	<tr>
		<td colspan="6" align="center">
                    <?=$dgUbicaciones;?>
                </td>
	</tr>
	<tr style="font-size: 8px; color: maroon" class="linEspacioD">
		<td colspan="6"></td>
	</tr>
	<tr>
		<td colspan="6">
		<div id="divResultados"></div>
		</td>
	</tr>
    </table>
</form>
</body>
</html>