<table width="100%" class="tblInformacion">
	<tr>
		<td class="celNombre" width="25%">Documento</td>
		<td width="25%"><?=$DOCUMENTO;?></td>
		<td class="celNombre" width="25%">Nacionalidad</td>
		<td width="25%"><?=$NACIONALIDAD;?></td>
	</tr>
	<tr>
		<td class="celNombre">Nombre</td>
		<td colspan="3"><?=$NOMBRE;?></td>
	</tr>
	<tr>
		<td class="celNombre">Nacimiento</td>
		<td><?=$NACIMIENTO;?></td>
		<td class="celNombre">Sexo</td>
		<td><?=$SEXO;?></td>
	</tr>
	<tr>
		<td class="celNombre">Nivel de Educacion</td>
		<td><?=$NIVEL_EDUCACION;?></td>
		<td class="celNombre"></td>
		<td></td>
	</tr>
	<tr>
		<td class="celNombre">Sector</td>
		<td><?=$SECTOR;?></td>
		<td class="celNombre">AFP</td>
		<td><?=$AFP;?></td>
	</tr>
	<tr>
		<td class="celNombre">Telefono 1</td>
		<td><?=$TELEFONO1;?></td>
		<td class="celNombre">Telefono 2</td>
		<td><?=$TELEFONO2;?></td>
	</tr>
	<tr>
		<td class="celNombre">Direccion1</td>
		<td colspan="3"><?=$DIRECCIONT;?></td>
	</tr>
	<tr>
		<td class="celNombre">UBIGEO1</td>
		<td colspan="3"><?=$TUbigeoO;?></td>
	</tr>
		<tr>
		<td class="celNombre">Direccion2</td>
		<td colspan="3"><?=$DIRECCIONA;?></td>
	</tr>
	<tr>
		<td class="celNombre">UBIGEO2</td>
		<td colspan="3"><?=$TUbigeoA;?></td>
	</tr>
	<tr>
		<td class="celNombre">RUC</td>
		<td colspan="3"><?=$RUC_PERSONAL;?></td>
	</tr>
	<tr>
		<td class="celNombre">GIRO</td>
		<td colspan="3"><?=$GIRO;?></td>
	</tr>
	<tr>
		<td class="celNombre">Direccion 3</td>
		<td colspan="3"><?=$DIRECCIONS;?></td>
	</tr>
	<tr>
		<td class="celNombre">UBIGEO 3</td>
		<td colspan="3"><?=$TUbigeoS;?></td>
	</tr>
	<tr>
		<td class="celNombre">FAMILIARES</td>
		<td colspan="3"><?=$dgFamiliares;?></td>
	</tr>

	<? if (mysql_num_rows($dtCargos)>0){?>
	<tr>
		<td class="celNombre" colspan="4" align="center">CARGOS</td>
	</tr>
	<tr>
		<td colspan="4">
		<table width="95%" align="center" class="tblInformacion">
			<thead>
				<tr class="dgCabecerax">
					<td width="18%">CARGO</td>
					<td width="38%">EMPRESA</td>
					<td width="18%">CONDICION</td>
					<td width="13%">FECHA ALTA</td>
					<td width="13%">FECHA BAJA</td>
				</tr>
			</thead>
			<? while($dtRow=mysql_fetch_array($dtCargos)){ ?>
			<tr>
				<td align="center"><?=$dtRow['CARGO'];?></td>
				<td align="center"><?=$dtRow['EMPRESA'];?></td>
				<td align="center"><?=$dtRow['CONDICION'];?></td>
				<td align="center"><?=$dtRow['FECHA_ALTA'];?></td>
				<td align="center"><?=$dtRow['FECHA_BAJA'];?></td>
			</tr>
			<?}?>
		</table>
		</td>
	</tr>
	<?}?>

	<? if (mysql_num_rows($dtAutos)>0){?>
	<tr>
		<td class="celNombre" colspan="4" align="center" >AUTOS</td>
	</tr>
	<tr>
		<td colspan="4">
		<table width="95%" align="center" class="tblInformacion">
			<thead>
				<tr class="dgCabecerax">
					<td width="10%">A&Ntilde;O FABR.</td>
					<td width="10%">N.TRANSF.</td>
					<td width="10%">MARCA</td>
					<td width="10%">MODELO</td>
					<td width="10%">TIPO</td>
					<td width="10%">DNI CONYUGUE</td>
					<td width="40%">CONYUGUE</td>
				</tr>
			</thead>
			<? while($dtRow=mysql_fetch_array($dtAutos)){ ?>
			<tr>
				<td align="center"><?=$dtRow['Fabricacion'];?></td>
				<td align="center"><?=$dtRow['NroTransferencia'];?></td>
				<td align="center"><?=$dtRow['Marca'];?></td>
				<td align="center"><?=$dtRow['Modelo'];?></td>
				<td align="center"><?=$dtRow['Tipo'];?></td>
				<td align="center"><?=$dtRow['Documento2'];?></td>
				<td align="center"><?=$dtRow['NCompleto2'];?></td>
			</tr>
			<?}?>
		</table>
		</td>
	</tr>
	<?}?>

</table>
