/*
Acciones del registro de usuario
*/
function ayudaFormUsuario() {
    urlDestino="usuario/gest_usuario.php";
    ayuda=new Array();
	  ayuda["Correo"]         = "Ingrese un correo valido. user@domain.com OBLIGATORIO";
	  ayuda["Nombre" ]        = "Ingrese su nombre. Solo letras y espacios. OBLIGATORIO";
	  ayuda["Apellidos"]      = "Ingrese sus apellidos.  Solo letras y espacios. OBLIGATORIO.";
	  ayuda["Clave"]          = "Ingrese una clave mayor a 5 caracteres. OBLIGATORIO";
	  ayuda["Confirmacion"]   = "Ingrese la confirmaci&oacute;n de la clave. OBLIGATORIO";
    ayuda["Genero"]         = "Seleccione el genero. OBLIGATORIO";
	  ayuda["Fecha"]          = "Seleccione su fecha de nacimiento. OBLIGATORIO";
    ayuda["Institucion"]    = "Seleccione la institucion al que pertenece. OBLIGATORIO";
	  ayuda["Talla"]          = "Seleccione la talla de polera que usa. OBLIGATORIO";
    ayuda["Nivel"]          = "Seleccione el nivel academico que cursa. OBLIGATORIO";
}

function limpiaForm() {
	for(i=0; i<=6; i++) {
		form.elements[i].className=claseNormal;
	}
}

function validaForm() {
	limpiaForm();
	error=0;

  var correo      = eliminaEspacios(form.correo.value);
	var clave1      = eliminaEspacios(form.passwd1.value);
	var clave2      = eliminaEspacios(form.passwd2.value);
	var nombre      = eliminaEspacios(form.nombre.value);
	var apellidos   = eliminaEspacios(form.apellidos.value);
  var fecha       = eliminaEspacios(form.fechaini.value);
  var genero      = eliminaEspacios(form.genero.value);
  var talla       = eliminaEspacios(form.talla.value);
  var institucion = eliminaEspacios(form.institucion.value);
  var nivel       = eliminaEspacios(form.nivel.value);

  if(!validaCorreo(correo)) campoError(form.correo);
	if(!validaLongitud(clave1, 0, 4, 50)) campoError(form.passwd1);
	if(!validaLongitud(clave2, 0, 4, 50)) campoError(form.passwd2);
	if(!validaLongitud(nombre, 0, 2, 50)) campoError(form.nombre);
	if(!validaLongitud(apellidos, 0, 2, 50)) campoError(form.apellidos);
  if(!validaLongitud(fecha, 0, 0, 10)) campoError(form.fechaini);
  if(!validaClaves(clave1,clave2)) campoError(form.passwd2);
  if(!validaCadena(nombre)) campoError(form.nombre);
  if(!validaCadena(apellidos)) campoError(form.apellidos);
  if(!validaFecha(fecha)) campoError(form.fechaini);

	if(error==1) {
		var texto="<img src='publico/design/error.gif' alt='Error'><br><br><h3>Error: revise los campos en rojo.</h3><br><br><input class='button' onClick='ocultaMensaje()' type='button' value='Aceptar'/>";
		muestraMensaje(texto);
	}
	else {

    var texto="<img src='publico/design/loading.gif' alt='Enviando'><br>Enviando su informacion. Por favor espere.<br /><br />";
		muestraMensaje(texto);

		var ajax=nuevoAjax();
		ajax.open("POST", urlDestino, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("agregar=OK&correo="+correo+"&clave1="+clave1+"&clave2="+clave2+"&nombre="+nombre+"&apellidos="+apellidos+"&fecha="+fecha+"&genero="+genero+"&talla="+talla+"&institucion="+institucion+"&nivel="+nivel);

		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				var respuesta=ajax.responseText;
				if(respuesta=="OK")
				{
					var texto="<img src='publico/design/ok.gif' alt='Ok'><br />El usuario fue correctamente registrado.<br /><br />Se ha enviado un mensaje de confirmacion a su correo electronico.<br><br><input class='button' onClick='irIndex()' type='button' value='Aceptar'/>";
				}else if(respuesta.indexOf("SMTP",0) >= 0) {
                $("#contenidoformulario").html("");
                var texto="<img src='publico/design/ok.gif'><br /><br />El usuario fue correctamente registrado\n pero no se pudo enviar el correo de confirmacion ya que\n El servicio de correo no esta disponible <br /><br /><input class='button' onClick='irIndex()' type='button' value='Aceptar'/>";
        }else
                var texto="<img src='publico/design/error.gif'><br /><br />Error: "+respuesta+" <br /><br /><input class='button' onClick='ocultaMensaje()' type='button' value='Aceptar'/>";
        muestraMensaje(texto);
			}
		}
	}
}

function irIndex() {
  document.location.href= "index.php";
}