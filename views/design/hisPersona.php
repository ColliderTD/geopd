<?
if(mysql_num_rows($dsHistorico)>0)
{
	?>

<table width="100%" class="tblInformacion">
	<tr>
		<td class="celNombre" width="15%" align="center">PERIODO</td>
		<td width="10%" class="celNombre" align="center">REPORTAN</td>
		<td class="celNombre" width="15%" align="center">OK</td>
		<td width="15%" class="celNombre" align="center">CPP</td>
		<td class="celNombre" width="15%" align="center">DEFICIENTE</td>
		<td width="15%" class="celNombre" align="center">DUDOSO</td>
		<td class="celNombre" width="15%" align="center">PERDIDA</td>
	</tr>

	<?
	while($dtRow=mysql_fetch_array($dsHistorico))
	{
		?>

	<tr>
		<td align="center"><?=$dtRow["ANIO"].'-'.$dtRow["MES"];?></td>
		<td align="center"><?=$dtRow["REPORTAN"];?></td>
		<td align="center"><?=$dtRow["OK"];?></td>
		<td align="center"><?=$dtRow["CPP"];?></td>
		<td align="center"><?=$dtRow["DEFICIENTE"];?></td>
		<td align="center"><?=$dtRow["DUDOSO"];?></td>
		<td align="center"><?=$dtRow["PERDIDA"];?></td>
	</tr>
	<?}
}
?>

</table>
