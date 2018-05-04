<?php
include("../config/Conexion.php");
include("../controlador/Controlador.php");
include("../controlador/index/ControlIndex.php");
include("../controlador/sesion/ControlSesion.php");
	
$sesion = new ControlSesion();
$sesion->estaEnsesion();
$pagina="anuncios/lista_anuncio.php";

if(isset($_GET['item'])) {
	switch($_GET['item']) {
		case 1:
		    if($sesion->getIdRol() != $sesion->ADMINISTRADOR) {
				header("Location:index.php");
			}
			$pagina = "anuncios/form_anuncio.php";
			break;
		case 2:
		    if($sesion->getIdRol() != $sesion->ADMINISTRADOR) {
				header("Location:index.php");
			}
			$pagina = "anuncios/form_actualizar_anuncio.php";
			break;
    case 3:
			$pagina = "anuncios/lista_anuncio.php";
			break;
    case 4:
	   if($sesion->getIdRol() != $sesion->ADMINISTRADOR) {
			header("Location:index.php");
	   }
      $pagina = "anuncios/lista_anuncio_editables.php";
      break;
		default:
			$pagina="anuncios/lista_anuncio.php";
			break;
	}
}
//temporizador();

$index = new ControlIndex();
$index->set_url_contenido($pagina);
$index->set_menu_actual("anuncios");
$index->index();
?>
