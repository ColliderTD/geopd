<?
//AJAX
define("1","<table width='100%'><tr><td align='center'><img src='include/images/iLoading.gif'/></td></tr></table>");
define("3","blanco");

//HTML
define("hvalPersona","onclick=\"valPersona('%s')\"");
define("hverEmpresa","onclick=\"verEmpresa('%s','%s')\"");
define("hverContrato","onclick=\"verEmpresa('%s','%s')\"");

//JavaScript
define("calendario",
"var %s = new CalendarPopup('%s');
document.write(getCalendarStyles());");

define("ginsUsuario","
function ginsUsuario(form)
{clnFormulario('%s')}");

define("chgDatos","
function chgDatos(form)
{var paterno = form.edtPaterno.value;
 var materno = form.edtMaterno.value;
 var nombres = form.edtNombres.value;

 if(paterno=='' && materno=='' && nombres=='')
 {form.edtDocumento.disabled=false;}
 else {form.edtDocumento.value='';
 form.edtDocumento.disabled=true;}}");

define("chgDocumento","
function chgDocumento(form)
{var documento = form.edtDocumento.value;
 if(documento=='')
 {form.edtPaterno.disabled=false;
  form.edtMaterno.disabled=false;
  form.edtNombres.disabled=false;}
 else
 {form.edtPaterno.value='';
  form.edtPaterno.disabled=true;
  form.edtMaterno.value='';
  form.edtMaterno.disabled=true;
  form.edtNombres.value='';
  form.edtNombres.disabled=true;}}");

define("valBsqPersona","
function valBsqPersona(form)
{var nombres = form.edtNombres.value;
 var paterno = form.edtPaterno.value;
 var materno = form.edtMaterno.value;
 var documento = form.edtDocumento.value;

 if((nombres!='' && paterno!='' && materno!='') || (documento!=''))
  {CnsPersona(form);return false;}else
  {alert('Ingrese los Datos Correspondiente');return false;}}");

define("valPersona","
function valPersona(dni)
{var myForm = document.createElement('form');
 myForm.method='POST';
 myForm.action='index.php?Page=DetPersona&Action=Valida';

 var myInput = document.createElement('input') ;
 myInput.setAttribute('name', 'Documento') ;
 myInput.setAttribute('value', dni);

 myForm.appendChild(myInput);
 document.body.appendChild(myForm);
 myForm.submit();
 document.body.removeChild(myForm);}");

define("verPersona","
function verPersona(codigo,tipoPersona)
{var myForm = document.createElement('form');
 myForm.method='POST';
 myForm.action='index.php?Page=DetPersona';

 var myInput = document.createElement('input') ;
 myInput.setAttribute('name', 'TipoPersona') ;
 myInput.setAttribute('value', tipoPersona);

 var myInputD = document.createElement('input') ;
 myInputD.setAttribute('name', 'Codigo') ;
 myInputD.setAttribute('value', codigo);

 myForm.appendChild(myInput);
 myForm.appendChild(myInputD);
 document.body.appendChild(myForm);
 myForm.submit();
document.body.removeChild(myForm);
}");

define("verEmpresa","
function verEmpresa(Ruc,Codigo)
{var myForm = document.createElement('form');
 myForm.method='POST';
 myForm.action='index.php?Page=Empresa&Action=verEmpresa';

 var myInput = document.createElement('input') ;
 myInput.setAttribute('name', 'sRuc') ;
 myInput.setAttribute('value', Ruc);

 var myInputD = document.createElement('input') ;
 myInputD.setAttribute('name', 'sCodigo') ;
 myInputD.setAttribute('value', Codigo);

 myForm.appendChild(myInput);
 myForm.appendChild(myInputD);
 document.body.appendChild(myForm);
 myForm.submit();
document.body.removeChild(myForm);
}");

?>