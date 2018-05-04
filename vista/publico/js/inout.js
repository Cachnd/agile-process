/*
Acciones del registro de usuario
*/

function ayudaFormUsuario() {
    urlDestino="administracion/gest_e-s.php";
    ayuda=new Array();
	ayuda["Nombre"]         = "Ingrese el Nombre de la institucion ha inscribir. OBLIGATORIO";
	ayuda["Direccion" ]     = "Ingrese la direccion de la institucion. OBLIGATORIO";
}

function limpiaForm() {
	for(i=0; i<=1; i++)
	{
		form.elements[i].className=claseNormal;
	}
}

function validaForm() {
	limpiaForm();
	error=0;


	var nombre=eliminaEspacios(form.nombre.value);
	var direccion=eliminaEspacios(form.direccion.value);

	if(!validaLongitud(nombre, 0, 2, 50)) campoError(form.nombre);
	if(!validaLongitud(direccion, 0, 2, 50)) campoError(form.direccion);
    if(!validaCadena(nombre)) campoError(form.nombre);

	if(error==1) {
		var texto="<img src='publico/design/error.gif' alt='Error'><br><br><h3>Error: revise los campos en rojo.</h3><br><br><input class='button' onClick='ocultaMensaje()' type='button' value='Aceptar'/>";
		muestraMensaje(texto);
	}
	else {

        var texto="<img src='publico/design/loading.gif' alt='Enviando'><br>Enviando la informacion. Por favor espere.<br /><br />";
		muestraMensaje(texto);

		var ajax=nuevoAjax();
		ajax.open("POST", urlDestino, true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        ajax.send("agregar=OK&nombre="+nombre+"&direccion="+direccion);

		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				var respuesta=ajax.responseText;
				if(respuesta=="OK")
				{
					var texto="<img src='publico/design/ok.gif' alt='Ok'><br />La institucion fue correctamente registrada.<br><input class='button' onClick='ocultaMensajeLimpiar()' type='button' value='Aceptar'/>";
				}
				else var texto="<img src='publico/design/error.gif'><br /><br />Error: "+respuesta+" <br /><br /><input class='button' onClick='ocultaMensaje()' type='button' value='Aceptar'/>";

				muestraMensaje(texto);
			}
		}
	}
}

function cancelar2() {
  document.location.href= "administracion.php";
}
