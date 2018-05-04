<?php
    include("../../config/Conexion.php");
    include("../../modelo/anuncio.php");
    include("../../controlador/Controlador.php");
    include("../../controlador/anuncio/ControlAnuncio.php");

    $controler = new ControlAnuncio();
    $anuncio = new Anuncio();

	if(isset($_POST['agregar'])) {
        //Accion Agregar
        $anuncio->titulo      = trim($_POST['titulo']);
        $anuncio->descripcion = trim($_POST['descripcion']);
        $anuncio->remitente   = trim($_POST['remitente']);
        $anuncio->fechaini    = trim($_POST['fechaini']);
        $anuncio->fechafin    = trim($_POST['fechafin']);
        $anuncio->horaini     = $_POST['horaini'].":".$_POST['minutoini'];
        $anuncio->horafin     = $_POST['horafin'].":".$_POST['minutofin'];


        if ($controler->registrar($anuncio)) {
           echo "OK";
        }else {
           echo $controler->indicarError();
        }

	}else if(isset($_POST['eliminar'])) {
        if($controler->eliminarAnuncio(trim($_POST['anuncio_id']))) {
           echo "OK";
        }else {
           echo $controler->indicarError(); 
        }
        
	}else if(isset($_POST['modificar'])) {
		$anuncio->titulo      = trim($_POST['titulo']);
        $anuncio->descripcion = trim($_POST['descripcion']);
        $anuncio->remitente   = trim($_POST['remitente']);
        $anuncio->fechaini    = trim($_POST['fechaini']);
        $anuncio->fechafin    = trim($_POST['fechafin']);
        $anuncio->horaini     = $_POST['horaini'].":".$_POST['minutoini'];
        $anuncio->horafin     = $_POST['horafin'].":".$_POST['minutofin'];
        $anuncio->ini_anuncio = trim($_POST['fechaini'])." ".$_POST['horaini'].":".$_POST['minutoini'];
        $anuncio->fin_anuncio = trim($_POST['fechafin'])." ".$_POST['horafin'].":".$_POST['minutofin'];
        $anuncio->anuncio_id  = trim($_POST['anuncio_id']);
        if($controler->actualizarRegistro($anuncio))
            echo "OK";
        else
          echo $controler->indicarError();
	}else {
          header("Location:index.php");
        }
?>