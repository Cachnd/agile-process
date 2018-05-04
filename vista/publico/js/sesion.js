function validaSesion() {
  form=document.getElementById("formularioSesion");
  divTransparenteSesion=document.getElementById("transparenciaSesion");
  divMensajeSesion=document.getElementById("transparenciaMensajeSesion");
  
  var correo=form.correo.value;
  var clave=form.clave.value;
  
  var texto="<img src='publico/design/loading.gif' alt='Enviando'><br>Enviando su informacion. Por favor espere.<br /><br />";
  muestraMensajeSesion(texto);
  
  if(correo == "") {
    var texto="<img src='publico/design/error.gif'><br /><br />Ingrese su correo <br /><br /><input class='button' onClick='ocultaMensajeSesion()' type='button' value='Aceptar'/>";
    muestraMensajeSesion(texto);
    return;
  }
  
  if(clave == "") {
    var texto="<img src='publico/design/error.gif'><br /><br />Ingrese su contrase&#241;a <br /><br /><input class='button' onClick='ocultaMensajeSesion()' type='button' value='Aceptar'/>";
    muestraMensajeSesion(texto);
    return;
  }
  
  
    var ajax=nuevoAjax();
    ajax.open("POST", "sesion/gest_sesion.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("sesion=OK&correo="+correo+"&clave="+clave);

    ajax.onreadystatechange=function() {
      if (ajax.readyState==4) {
        var respuesta=ajax.responseText;
        
        if(respuesta=="OK") {
          document.location.href= "../index.php";
        }
        else {
          var texto="<img src='publico/design/error.gif'><br /><br />Error: "+respuesta+" <br /><br /><input class='button' onClick='ocultaMensajeSesion()' type='button' value='Aceptar'/>";
          muestraMensajeSesion(texto);
        }
          
      }
    }
  
}
/* 
Conseguimos el enter de teclado y ejecutamos 
la validacion del formulario
*/
	function eventoTeclado(cod){
	switch (cod){
		 case 13: validaSesion(); break; // Enter
		 
		}
	}
	
	//Se obtiene el codigo de la tecla presionada: 1 = presionado y 0 = No presionado
	document.onkeydown=function(e){eventoTeclado((e||window.event).keyCode);};


function muestraMensajeSesion(mensaje) {
  divMensajeSesion.innerHTML=mensaje;
  divTransparenteSesion.style.display="block";  
}

function ocultaMensajeSesion()
{
  divTransparenteSesion.style.display="none";
}
