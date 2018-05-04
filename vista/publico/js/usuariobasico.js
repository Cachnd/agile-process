function ayudaFormUsuario() {
    urlDestino="usuario/gest_usuario_basico.php";
    ayuda=new Array();
	  ayuda["Correo"]         = "Ingrese un correo valido. user@domain.com OBLIGATORIO";
	  ayuda["Nombre" ]        = "Ingrese su nombre. Solo letras y espacios.";
	  ayuda["Apellidos"]      = "Ingrese sus apellidos.  Solo letras y espacios.";
	  ayuda["Genero"]         = "Seleccione el genero. OBLIGATORIO";
    ayuda["Institucion"]    = "Seleccione la institucion al que pertenece. OBLIGATORIO";
}

function limpiaForm() {
	for(i=0; i<=3; i++) {
		form.elements[i].className=claseNormal;
	}
}

function validaForm(ruta) {
	limpiaForm();
	error=0;

  var correo      = eliminaEspacios(form.correo.value);
	var nombre      = eliminaEspacios(form.nombre.value);
	var apellidos   = eliminaEspacios(form.apellidos.value);
  var genero      = eliminaEspacios(form.genero.value);
  var institucion = eliminaEspacios(form.institucion.value);

  if(!validaCorreo(correo)) campoError(form.correo);
  
	if(nombre == "") {
	   if(!validaLongitud(nombre,1, 2, 50)) campoError(form.nombre);
	}
	else {
	   if(!validaLongitud(nombre,0, 2, 50)) campoError(form.nombre);
	   if(!validaCadena(nombre)) campoError(form.nombre);
	}

	if(apellidos == "") {
	  if(!validaLongitud(apellidos,1, 2, 50)) campoError(form.apellidos);
	}
  else {
      if(!validaLongitud(apellidos,0, 2, 50)) campoError(form.apellidos);
	    if(!validaCadena(apellidos)) campoError(form.apellidos);  
	}

	if(error==1)	{
		var texto="<img src='publico/design/error.gif' alt='Error'><br><br><h3>Error: revise los campos en rojo.</h3><br><br><input class='button' onClick='ocultaMensaje()' type='button' value='Aceptar'/>";
		muestraMensaje(texto);
	}
	else {
		var texto="<img src='publico/design/loading.gif' alt='Enviando'><br>Enviando su informacion. Por favor espere.<br /><br />";
		muestraMensaje(texto);

		var ajax=nuevoAjax();
		ajax.open("POST", urlDestino, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		ajax.send("agregar=OK&correo="+correo+"&nombre="+nombre+"&apellidos="+apellidos+"&genero="+genero+"&institucion="+institucion);

		ajax.onreadystatechange=function() {
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				if(respuesta=="OK")
				{
					var texto="<img src='publico/design/ok.gif' alt='Ok'><br />El usuario fue correctamente registrado.<br />Se ha enviado un mensaje de confirmacion a su correo electronico.<br><br><input class='button' onClick='irA(\""+ruta+"\");' type='button' value='Aceptar'/>";
				}
				else var texto="<img src='publico/design/error.gif'><br /><br />Error: "+respuesta+" <br /><br /><input class='button' onClick='irA(\""+ruta+"\");' type='button' value='Aceptar'/>";

				muestraMensaje(texto);
			}
		}
	}
}

function validarParticipante(url) {
  validaForm(url);
}

function formRegistroEquipo(url) {
  document.location.href= url;
}

function formActualizarEquipo(url) {
  document.location.href= url;
}

function validarJuez(url) {
  validaForm(url);
}

function formAsociarJuez(url) {
  document.location.href= url;
}

function irA(url) {
  document.location.href= url;
}