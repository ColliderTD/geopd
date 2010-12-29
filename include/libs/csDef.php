<?
//AJAX
define("1","<table width='100%'><tr><td align='center'><img src='include/images/iLoading.gif'/></td></tr></table>");
define("3","blanco");

//HTML
define("hvalPersona","onclick=\"valPersona('%s')\"");
define("hverEmpresa","onclick=\"verEmpresa('%s','%s')\"");
define("hverContrato","onclick=\"verEmpresa('%s','%s')\"");

//JavaScript

define("iconos","var iconBlue = new GIcon();
    iconBlue.image = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
    iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconBlue.iconSize = new GSize(12, 20);
    iconBlue.shadowSize = new GSize(22, 20);
    iconBlue.iconAnchor = new GPoint(6, 20);
    iconBlue.infoWindowAnchor = new GPoint(5, 1);

    var iconRed = new GIcon();
    iconRed.image = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
    iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconRed.iconSize = new GSize(12, 20);
    iconRed.shadowSize = new GSize(22, 20);
    iconRed.iconAnchor = new GPoint(6, 20);
    iconRed.infoWindowAnchor = new GPoint(5, 1);

    var customIcons = [];
    customIcons[\"restaurant\"] = iconBlue;
    customIcons[\"bar\"] = iconRed;
");

define("loadgmaps","function loadMap(Max,Min) {

       document.title = \"GEOPD - Vista detalle\";

      var f = document.forms['buscarubicaciones'];

      var now = new Date();

      f.elements['edtFec1'].value = now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate();
      f.elements['edtFec2'].value = now.getFullYear()+'-'+(now.getMonth()+1)+'-'+now.getDate();

      if (GBrowserIsCompatible()) { 
        var map = new GMap2(document.getElementById(\"map\"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(-12.05, -77.05), 13);

        var url = 'index.php?Page=BB&Action=Genxml&FechaMax='+Max+'&FechaMin='+Min;
       
        GDownloadUrl(url, function(data) {
          var xml = GXml.parse(data);
          var salida = '<table class=\"tblInformacion\"><th>Fecha</th><th>&nbsp</th><th width=\"300px\">Direccion</th><th>&nbsp</th><th width=\"100px\">Distrito</th><th>&nbsp</th><th width=\"100px\">Ciudad</th><th>&nbsp</th><th width=\"100px\">Departamento</th><th>&nbsp</th><th width=\"100px\">Pais</th>';

          //var listado = salida;

          var markers = xml.documentElement.getElementsByTagName(\"ubicacion\");

          for (var i = 0; i < markers.length; i++) {
       
            var name = markers[i].getAttribute(\"CelularBBID\");
            var direccion = markers[i].getAttribute(\"Calle\");
            var distrito = markers[i].getAttribute(\"Distrito\");
            var ciudad = markers[i].getAttribute(\"Ciudad\");
            var departamento = markers[i].getAttribute(\"Departamento\");
            var pais = markers[i].getAttribute(\"Pais\");
            var Fecha = markers[i].getAttribute(\"Fecha\");
            var type = markers[i].getAttribute(\"type\");
            var point = new GLatLng(parseFloat(markers[i].getAttribute(\"Latitud\")),
                                    parseFloat(markers[i].getAttribute(\"Longitud\")));
            var marker = createMarker(point, name, Fecha, type);
            map.addOverlay(marker);

            //listado = listado  + '<tr><td>' + Fecha + '</td><td>&nbsp</td><td>' + direccion + '</td><td>' + distrito + '</td><td>' + ciudad + '</td><td>' + departamento + '</td><td>' + pais + '</td></tr>';
          
            if(i<10)
                salida = salida + '<tr><td>' + Fecha + '</td><td>&nbsp</td><td>' + direccion + '</td><th>&nbsp</th><td>' + distrito + '</td><th>&nbsp</th><td>' + ciudad + '</td><th>&nbsp</th><td>' + departamento + '</td><th>&nbsp</th><td>' + pais + '</td></tr>';

           }
            var txt=document.getElementById('divSalida');
            txt.innerHTML= salida + '</table>';

            //var txt2=document.getElementById('divListado');
            //txt2.innerHTML= listado + '</table>';

          map.setCenter(new GLatLng(parseFloat(markers[markers.length-1].getAttribute(\"Latitud\")),parseFloat(markers[markers.length-1].getAttribute(\"Longitud\"))), 13);
        });    
      }
    }
");


define("createmarkergmaps","function createMarker(point, name, Fecha, type) {
      var marker = new GMarker(point, customIcons[type]);
      var html = \"<b>\" + name + \"</b> <br/>\" + Fecha;
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
      });
      return marker;
    }");

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

define("busqueda","function Consulta()
{
    var f = document.forms['buscarubicaciones'];

    var horainicio = f.elements['edtHoraInicio'].value;
    var horafin = f.elements['edtHoraFin'].value;
    var fechainicio = f.elements['edtFec1'].value;
    var fechafin = f.elements['edtFec2'].value;

    var max = fechafin + \" \" + horafin + \":00\";
    var min = fechainicio + \" \" + horainicio + \":00\";

    if(horainicio == '' || horafin == '' || fechainicio == '' || fechafin == '')
        alert('Debe llenar todos los campos.');
    else
        loadMap(max,min);
}");

define("popupfullscreen","function popupfullscreen(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, ',type=fullWindow,fullscreen,scrollbars=yes');
return false;
}

");
define("ampliar","function Ampliar()
{
    var f = document.forms['buscarubicaciones'];

    var horainicio = f.elements['edtHoraInicio'].value;
    var horafin = f.elements['edtHoraFin'].value;
    var fechainicio = f.elements['edtFec1'].value;
    var fechafin = f.elements['edtFec2'].value;

    var max = fechafin + \" \" + horafin + \":00\";
    var min = fechainicio + \" \" + horainicio + \":00\";

    popupfullscreen(\"index.php?Page=BBAmpliar&max=\"+max+\"&min=\"+min,\"Vista amplificada\");


}");

define("imprimir","function ImprimirReporte()
{
    var f = document.forms['buscarubicaciones'];

    var horainicio = f.elements['edtHoraInicio'].value;
    var horafin = f.elements['edtHoraFin'].value;
    var fechainicio = f.elements['edtFec1'].value;
    var fechafin = f.elements['edtFec2'].value;

    var max = fechafin + \" \" + horafin + \":00\";
    var min = fechainicio + \" \" + horainicio + \":00\";

    popupfullscreen(\"index.php?Page=BBImprimir&max=\"+max+\"&min=\"+min,\"Geopd - Reporte de lugares\");

}");

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