<?php
	if(isset($_POST['sesion'])) {
        //Accion Agregar
        include("../../config/Conexion.php");
        include("../../controlador/Controlador.php");
        include("../../controlador/sesion/ControlSesion.php");

        $correo     = trim($_POST['correo']);
        $clave      = trim($_POST['clave']);

        $controler = new ControlSesion();
        if($controler->iniciar_sesion($correo,$clave)) {
          echo "OK";
        }else {
          echo $controler->indicarError(); 
        }

	}else if(isset($_GET['salir'])) {
        //Accion Salir
        include("../../config/Conexion.php");
        include("../../controlador/Controlador.php");
        include("../../controlador/sesion/ControlSesion.php");

        $controler = new ControlSesion();
        $controler->cerrar_sesion();

        header("Location:../index.php");
	}else if(isset($_GET['ver'])) {
		//Accion Ver
		header("Location:../index.php");
	}
?>