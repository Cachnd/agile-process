/*
Acciones del registro de anuncio
*/
function ayudaFormAnuncio() {
    urlDestino="anuncios/gest_anuncio.php";
    ayuda=new Array();
	  ayuda["Titulo"]         = "Ingrese el Titulo del Anuncio.  Mas de 3 letras. OBLIGATORIO.";
	  ayuda["Descripcion" ]   = "Ingrese la descripcion del anuncio. Mas de 3 letras.OBLIGATORIO";
	  ayuda["Remitente"]      = "Ingrese el nombre del Remitente. Solo letras y espacios.";
    ayuda["Fecha Inicio"]   = "Ingrese la fecha de inicio del anuncio. Debe ser mayor o igual a la fecha actual. OBLIGATORIO";
    ayuda["Hora Inicio"]    = "Ingrese la hora de inicio del anuncio. Debe ser mayor a la hora actual si se mostrara en una fecha actual. Debe ser menor a la hora de fin si se mostrara en una sola fecha.";
    ayuda["Fecha Fin"]      = "Ingrese la fecha de fin del anuncio. Debe ser mayor o igual a la fecha de inicio. OBLIGATORIO";
    ayuda["Hora Fin"]       = "Ingrese la hora de fin del anuncio. Debe ser mayor a hora de inicio si se mostrara en una sola fecha.";
}

function limpiaForm() {
	for(i=0; i<=10; i++) {
		form.elements[i].className=claseNormal;
	}
}

function validarForm() {
	limpiaForm();
	error=0;

	var titulo      = eliminaEspacios(form.titulo.value);
  var descripcion = eliminaEspacios(form.descripcion.value);
  var remitente   = eliminaEspacios(form.remitente.value);
  var fechaini    = eliminaEspacios(form.fechaini.value);
  var horaini     = eliminaEspacios(form.horaini.value);
	var minutoini   = eliminaEspacios(form.minutoini.value);
  var fechafin    = eliminaEspacios(form.fechafin.value);
  var horafin     = eliminaEspacios(form.horafin.value);
	var minutofin   = eliminaEspacios(form.minutofin.value);


  if(!validaLongitud(titulo, 0, 3, 255)) campoError(form.titulo);
  if(!validaLongitud(descripcion, 0, 3, 1000)) campoError(form.descripcion);
  if(!validaCadena(remitente)) campoError(form.remitente);
  if(!validaFechaIni(fechaini)) campoError(form.fechaini);
  if(!validaFechaIni(fechafin)) campoError(form.fechafin);
  if(fechaIgualFechaActual(fechaini)) {
         if(!validaHoraIni(minutoini, horaini)) {
                campoError(form.minutoini);
		            campoError(form.horaini);
         }
  }
  if(!validaFechas2(fechaini,fechafin)) campoError(form.fechafin);
  if(!verificarDisponibilidad(minutoini, minutofin, horaini, horafin, fechaini, fechafin)) {
		campoError(form.minutofin);
		campoError(form.horafin);
  }

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
		ajax.send("agregar=OK&titulo="+titulo+"&descripcion="+descripcion+"&remitente="+remitente+"&fechaini="+fechaini+"&fechafin="+fechafin
		+"&horaini="+horaini+"&horafin="+horafin+"&minutoini="+minutoini+"&minutofin="+minutofin);

		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				var respuesta=ajax.responseText;
				if(respuesta=="OK") {
					var texto="<img src='publico/design/ok.gif' alt='Ok'><br />El anuncio fue correctamente registrado.<br /><br><br><input class='button' onClick='irAnuncios()' type='button' value='Aceptar'/>";
				}
				else var texto="<img src='publico/design/error.gif'><br /><br />Error: "+respuesta+" <br /><br /><input class='button' onClick='ocultaMensaje()' type='button' value='Aceptar'/>";

				muestraMensaje(texto);
			}
		}
	}
}

function irAnuncios() {
  document.location.href= "anuncios.php";
}

function irModificacionAnuncios() {
  document.location.href= "anuncios.php?item=4";
}

function eliminar(id_anuncio)  {
  if(confirm("¿ Esta seguro que quiere eliminar este anuncio ?")) {
    var texto="<img src='publico/design/loading.gif' alt='Enviando'><br>Enviando su informacion. Por favor espere.<br /><br />";
    muestraMensaje(texto);

    var ajax=nuevoAjax();
    ajax.open("POST","anuncios/gest_anuncio.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("eliminar=OK&anuncio_id="+id_anuncio);

    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
        var respuesta=ajax.responseText;
        if(respuesta == "OK") {
          var texto = "<img src='publico/design/ok.gif' alt='Ok'><br />El anuncio fue correctamente eliminado.<br /><br /><input class='button' onClick='irModificacionAnuncios()' type='button' value='Aceptar'/>";
        }
        else var texto = "<img src='publico/design/error.gif'><br /><br />Error: "+respuesta+" <br /><br /><input class='button' onClick='ocultaMensaje()' type='button' value='Aceptar'/>";

        muestraMensaje(texto);
      }
    }
  }
}