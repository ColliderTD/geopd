<table width="100%" class="tblInformacion">
	<tr>
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="4">
		<table width="100%" class="tblInformacion">
			<tr class="fila-titulo">
				<td width="40%" class="celNombre">ENTIDAD</td>
				<td width="12%" class="celNombre">PRESTAMO</td>
				<td width="12%" class="celNombre">TC USADA</td>
				<td width="12%" class="celNombre">LINEA DISPONIBLE</td>
				<td width="12%" class="celNombre">HIPOTECARIO</td>
				<td width="12%" class="celNombre">AUTO</td>
			</tr>
			<? while($dtRow=mysql_fetch_array($dsResumen)) { ?>
			<tr>
				<td align="left"><?=$dtRow['ENTIDAD'];?></td>
				<td align="center"><?=$dtRow['DEUDA_PPTOT'];?></td>
				<td align="center"><?=$dtRow['DEUDA_TCTOT'];?></td>
				<td align="center"><?=$dtRow['DEUDA_TCLND'];?></td>
				<td align="center"><?=$dtRow['DEUDA_HITOT'];?></td>
				<td align="center"><?=$dtRow['DEUDA_AUTOT'];?></td>
			</tr>
			<? }?>
		</table>
		</td>
	</tr>
</table>
