<?php
include("../config/Conexion.php");
include("../controlador/Controlador.php");
include("../controlador/index/ControlIndex.php");
//include("parciales/temporizador.php");
include("../controlador/sesion/ControlSesion.php");

$sesion = new ControlSesion();
$sesion->estaEnsesion();
$pagina="paginas/informacion.php";

if(isset($_GET['item'])) {
	switch($_GET['item']) {
		case 1:
			$pagina = "paginas/informacion.php";
			break;
		case 2:
			$pagina = "paginas/reglamento.php";
			break;
    case 3:
			$pagina = "paginas/contactenos.php";
			break;
    case 4:
	        if(!$sesion->estaEnSesion()) {
				header("Location:index.php");
		    }
            $pagina = "usuario/ver_perfil.php";
             break;
		case 6:
		    if($sesion->estaEnSesion()) {
			   header("Location:index.php");
		    }
			$pagina = "usuario/form_usuario.php";
			break;
    case 5:
	        if($sesion->estaEnSesion()) {
			     header("Location:index.php");
		    }
			$pagina = "usuario/form_olvido_clave.php";
			break;
		case 7:
		    if(!$sesion->estaEnSesion()) {
			     header("Location:index.php");
		    }
			$pagina = "usuario/editar_perfil.php";
			break;
		case 8:
		    if(!$sesion->estaEnSesion()) {
			     header("Location:index.php");
		    }
			$pagina = "usuario/form_actualizar_usuario.php";
			break;
		default:
			$pagina = "paginas/informacion.php";
			break;
	}
}

if( isset($_GET['accion']) ) {
                      
        if($_GET['accion'] == 'registrar') {
                if($sesion->estaEnSesion()) {
		     header("Location:index.php");
	        }
          	$pagina="usuario/form_usuario.php";
        }
        if($_GET['accion'] == 'modificar') {
		if(!$sesion->estaEnSesion()) {
			header("Location:index.php");
	        }
          	$pagina="usuario/form_actualizar_usuario.php";
        } 
        if($_GET['accion'] == 'construccion')
            $pagina="paginas/construccion.php";  
}

//temporizador();
          	
$index = new ControlIndex();
$index->set_url_contenido($pagina);
$index->set_menu_actual("inicio");
$index->index();
?>
