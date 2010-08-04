<?
if(mysql_num_rows($dsLaboral)>0)
{
	?>

<table width="100%" class="tblInformacion">
	<tr>
		<td class="celNombre" width="10%">RUC</td>
		<td width="47%" class="celNombre">EMPRESA</td>
		<td class="celNombre" width="10%">FEC. REPORTE</td>
		<td width="8%" class="celNombre">CONDICION</td>
		<td class="celNombre" width="5%">ESSALUD</td>
		<td width="5%" class="celNombre">AFP</td>
	</tr>

	<?
	while($dtRow=mysql_fetch_array($dsLaboral))
	{
		?>

	<tr>
		<td><?=htmlentities($dtRow["RUC"]);?></td>
		<td><?=htmlentities($dtRow["EMPRESA"]);?></td>
		<td><?=$dtRow["DEVENGUE"];?></td>
		<td><?=htmlentities($dtRow["CONDICION"]);?></td>
		<td><?=$dtRow["INGRESO"];?></td>
		<td><?=$dtRow["INGRESOA"];?></td>
	</tr>
	<?}
}
?>

</table>
