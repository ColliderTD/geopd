<? include("HeadView.php");?>
<form name="proyecto" id="proyecto" action="" method="post">
<table class="dgPrincipal" width="100%">
	<tr class="linEspacioQ">
		<td colspan="6"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="6">BUSQUEDA DE PERSONAS</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="6"></td>
	</tr>
	<tr class="linColor">
		<td colspan="6"></td>
	</tr>
	<tr class="dgCabecera">
		<td width="10%">VER</td>
		<td width="12%">DI</td>
		<td width="50%">Nombres</td>
		<td width="8%">TipoDocumento</td>
		<td width="20%">TipoPersona</td>
	</tr>
	<tr class="linColor">
		<td colspan="6"></td>
	</tr>

	<? while($dtRow=mysql_fetch_array($dtValPersona)) { ?>
	<tr
		onClick="verPersona('<?=$dtRow['CODIGO'].'\',\''.$dtRow['CTIPOPERSONA']?>')"
		onMouseOver="setPointer(this,'#FFFF75');"
		onMouseOut="setPointer(this,'#FFFFFF');">
		<td><img src="include/images/iDetalle.gif" width="18" height="18" /></td>
		<td><?=$dtRow["DOCUMENTO"]?></td>
		<td align="left"><?=$dtRow["NOMBRES"]?></td>
		<td><?=$dtRow["TIPODOCUMENTO"]?></td>
		<td><?=$dtRow["TIPOPERSONA"]?></td>
	</tr>
	<tr class="linColor">
		<td colspan="6"></td>
	</tr>
	<? }?>

	<tfoot>
		<tr class="linEspacioD">
			<td colspan="6"></td>
		</tr>
		<tr>
			<td colspan="6"></td>
		</tr>
	</tfoot>
</table>
</form>
<? include("FootView.php");?>