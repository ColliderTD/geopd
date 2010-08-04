<? include("HeadView.php");?>
<form name="proyecto" id="proyecto" action="" method="post">
<table width="95%" class="tblBusqueda">
	<tr class="linEspacioC">
		<td colspan="4"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="4">$Titulo</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="4"></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Usuario</td>
		<td><?=$edtDocumento;?></td>
		<td>Nombres :</td>
		<td><?=$edtNombres;?></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Paterno :</td>
		<td><?=$edtPaterno;?></td>
		<td>Materno :</td>
		<td><?=$edtMaterno;?></td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><?=$btnBuscar;?></td>
	</tr>
	<tr style="font-size: 8px; color: maroon" class="linEspacioD">
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="4">
		<div id="divResultados"></div>
		</td>
	</tr>
</table>
</form>
<? include("FootView.php");?>