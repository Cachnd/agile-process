/*
Las validaciones de los formularios
*/
function eliminaEspacios(cadena) {
	// Funcion para eliminar espacios delante y detras de cada cadena
	while(cadena.charAt(cadena.length-1)==" ") cadena=cadena.substr(0, cadena.length-1);
	while(cadena.charAt(0)==" ") cadena=cadena.substr(1, cadena.length-1);
	return cadena;
}

function validaLongitud(valor, permiteVacio, minimo, maximo)
{
	var cantCar=valor.length;
	if(valor=="")
	{
		if(permiteVacio) return true;
		else return false;
	}
	else
	{
		if(cantCar>=minimo && cantCar<=maximo) return true;
		else return false;
	}
}

function validaCorreo(valor)
{
	var reg=/(^[a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30}$)/;
	if(reg.test(valor)) return true;
	else return false;
}

function validaClaves(a, b) {
  return a == b;
}

function validaCadena(cadena) {
    var i=0;
    var mal = false;

	while (i < cadena.length) {
        c = cadena.charCodeAt(i);
		//
		if(  (c >= 65 && c <= 90 ) || ( c >= 97 && c <= 122 ) || c == 32 || c == 209 || c == 241){
		   mal = true;
		   i++;
		}else {
		   mal = false;
		   break;
		}
	}
	return mal;
}

function validaCadena2(cadena) {
    var i=0;
    var mal = false;

	while (i < cadena.length) {
        c = cadena.charCodeAt(i);
		//
		if(  (c >= 65 && c <= 90 ) || ( c >= 97 && c <= 122 ) || c == 32 || c == 209 || c == 241 || c == 46){
		   mal = true;
		   i++;
		}else {
		   mal = false;
		   break;
		}
	}
	return mal;
}

function validaFecha(fecha) {
    fechaactual = new Date();
    year = fechaactual.getFullYear();
    partes = fecha.split("-");
    if(partes.length > 3) {
        res = false;
    }else if(partes[0] < year-5 ) {
        res = true;
    }else {
        res = false;
    }
    return res;
}

function validaHoraIni(minutoini, horaini) {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes() ;

    if (hours < horaini) {
      res = true;
    } else if (hours==horaini) {
        if (minutes <= minutoini)
            res = true;
        else
            res = false;

    } else
        res = false;
    return res;
}

function quitarCeroAntes(numero) {
	for(i=1 ; i <= 9 ; i++) {
		if(numero == "0"+i) {
		   numero = numero.replace("0","");
		   break;
		}
	}
	return numero;
}

function validaHoras(horaini, minutoini, horafin, minutofin) {
    
	horaini = quitarCeroAntes(horaini)
	horafin = quitarCeroAntes(horafin)
	minutoini = quitarCeroAntes(minutoini);
	minutofin = quitarCeroAntes(minutofin);
	
    if(parseInt(horaini) < parseInt(horafin)) {
      res = true;
    }else if(parseInt(horaini) == parseInt(horafin)) {
        if(parseInt(minutoini) < parseInt(minutofin)) {
          res = true;
        }else {
          res = false;
        }
    }else {
      res = false;
    }
    return res;
}

function validaFechaIni(fecha) {
    fechaactual = new Date();
    year = fechaactual.getFullYear();
    month = fechaactual.getMonth()+1;
    day = fechaactual.getDate();
    partes = fecha.split("-");
    if(partes.length > 3) {
        res = false;
    } else if(partes[0] < year ) {
        res = false;
    } else if (partes[0]==year) {
        if(partes[1] < month ){
            res = false;
        } else if (partes[1]==month) {
            if(partes[2] < day )
                res = false;
            else
                res=true;
        } else
            res=true;
    } else
        res = true;
    return res;
}

function fechaIgualFechaActual(fecha) {
    fechaactual = new Date();
    year = fechaactual.getFullYear();
    month = fechaactual.getMonth()+1;
    day = fechaactual.getDate();
    dia = day+"";
    if(day < 10)dia = "0"+day;
    return year+"-"+month+"-"+dia == fecha;
}

function validaFechas2(ini,fin) {
    partesini = ini.split("-");
    partesfin = fin.split("-");
    if( partesini.length > 3 || partesfin.length > 3) {
        res = false;
    }else if( parseInt(partesini[0]) < parseInt(partesfin[0]) ) {
        res = true;
    }else if( parseInt(partesini[0]) == parseInt(partesfin[0]) ){
        if(partesini[1] < partesfin[1]) {
            res = true;
        }else if( parseInt(partesini[1]) == parseInt(partesfin[1]) ) {
            if( parseInt(partesini[2]) <= parseInt(partesfin[2]) ) {
                res = true;
            }else {
                res = false;
            }
        }else {
            res = false;
        }
    }else {
        res = false;
    }
    return res;
}

function validaFechas3(ini,fin) {
    partesini = ini.split("-");
    partesfin = fin.split("-");
    if( partesini.length > 3 || partesfin.length > 3) {
        res = false;
    }else if( parseInt(partesini[0]) < parseInt(partesfin[0]) ) {
        res = true;
    }else if( parseInt(partesini[0]) == parseInt(partesfin[0]) ){
        if(partesini[1] < partesfin[1]) {
            res = true;
        }else if( parseInt(partesini[1]) == parseInt(partesfin[1]) ) {
            if( parseInt(partesini[2]) < parseInt(partesfin[2]) ) {
                res = true;
            }else {
                res = false;
            }
        }else {
            res = false;
        }
    }else {
        res = false;
    }
    return res;
}

function verificarDisponibilidad(minini, minfin, horaini, horafin, fechaini, fechafin) {
  if (fechaini==fechafin) {
    return validaHoras(horaini,minini, horafin, minfin);
  } else {
    res = true;
  }
  return res;
}

function validaEntrenamiento(entrenamiento) {
   if(entrenamiento=="vacio") {
     return false;
   }else {
     return true;
   }
}

function comparaFechas(ini,fin) {
 
    var partesini = ini.split("-");
    var partesfin = fin.split("-");

    if( partesini.length > 3 || partesfin.length > 3) {
       var res = -1;
    }else {
            if( parseInt(partesini[0]) < parseInt(partesfin[0]) ) {
            res = 1;
            }else{
                  if( parseInt(partesini[0]) == parseInt(partesfin[0]) ){

                       if(partesini[1] < partesfin[1]) {
                         res = 1;
                       }else {
                              if( parseInt(partesini[1]) == parseInt(partesfin[1]) ) {

                                   if( parseInt(partesini[2]) < parseInt(partesfin[2]) ) {
                                       res = 1;
                                    }else {
                                        if( parseInt(partesini[2]) == parseInt(partesfin[2])){
                                           res = 0;
                                        }else{
                                          res = -1;
                                        }

                                    }
                              }else {
                                     res = -1;
                              }
                       }
                 }else {
                       res = -1;

                 }
            }
    }
    return res;
 }
