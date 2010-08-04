<? include("HeadView.php");?>
<form name="proyecto" id="proyecto" action="" method="post" onsubmit='javascript:return valBsqPersona(this);'>
<table width="50%" class="tblBusqueda">
	<tr class="linEspacioC">
		<td colspan="2"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="2">BUSQUEDA DE PERSONAS</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="2"></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Documento :</td>
		<td><?=$edtDocumento;?></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Nombres :</td>
		<td><?=$edtNombres;?></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Paterno :</td>
		<td><?=$edtPaterno;?></td>

	</tr>
	<tr class="lblPrincipal">
		<td>Materno :</td>
		<td><?=$edtMaterno;?></td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="22"></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><?=$btnBuscar;?></td>
	</tr>
</table>
<table width="80%" class="tblBusqueda">
	<tr class="linEspacioD">
		<td colspan="2"></td>
	</tr>
	<tr class="linColor">
		<td colspan="2"></td>
	</tr>
	<tr class="linEspacioD">
		<td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="2">
		<div id="divResultados"></div>
		</td>
	</tr>
</table>
</form>
<? include("FootView.php");?>
<div id="blanket" style="display: none;"></div>
<div id="popUpDiv" style="display: none; width: 685px; height: 435px">asd

</div>
<?if ($_SESSION['popUpIni']!=null){?>
<SCRIPT LANGUAGE='JavaScript'>
popup('popUpDiv');
document.getElementById("popUpDiv").innerHTML='<table><tr class="menBarra"><td align="right"><a href="javascript:popup(\'popUpDiv\')">Cerrar</a> </td></tr><tr><td><img src="include/images/propaganda.jpg"/></td></tr></table>';
</SCRIPT>
<?$_SESSION['popUpIni']=null;}?>