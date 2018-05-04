<?php
class ControlSesion extends Controlador {
  
   var $ADMINISTRADOR   = 1;
   var $USUARIO_NOMINAL = 2;
   var $USUARIO         = 6;
   var $menu;

   function iniciar_sesion($correo, $clave) {
      $sql = "SELECT iniciarsesion('".$correo."','".$clave."');";
      return $this->iniciar_variables_sesion($this->consultar($sql)); 
   }

   function inisesion($correo) {
      $sql = "SELECT clave_usr FROM usuario_nominal WHERE correo_usr='$correo'";
      $clave= pg_fetch_array($this->consultar($sql),0);
      $this->iniciar_sesion($correo, $clave[0]);
   }

   function inisesionsinclave($correo) {
      $sql = "SELECT iniciarsesionsinclave('$correo');";
      return $this->iniciar_variables_sesion($this->consultar($sql));
   }

   private function iniciar_variables_sesion($usuario) {
     if($usuario) {
        $usuario = pg_fetch_array($usuario,0);
        if($usuario[0] != 'No encontrado') {
          $usuario = explode(',',$usuario[0]);
          $id_usuario     = $usuario[0];
          $nombre_usuario = $usuario[1];
          $id_sesion      = $usuario[2];
          $rol = $this->consultar("SELECT min(rol_id) FROM privilegios WHERE usr_id = $id_usuario;");
          $rol_id = pg_fetch_array($rol,0);
          $rol_id = $rol_id[0];
          session_name("sesionACM");
          session_start();
          $_SESSION['id']        = $id_usuario;
          $_SESSION['nombre']    = $nombre_usuario;
          $_SESSION['id_sesion'] = $id_sesion;
          $_SESSION['id_rol']    = $rol_id;
          $_SESSION['participantes']        = array();
          return true;
        }else {
          $this->error="El correo o la contrase&#241;a estan incorrectos";
          return false;
        }
      }else {
         $this->error="No hay conexion con la base de datos";
         return false;  
      }
   }
  
   function cerrar_sesion() {
      session_name("sesionACM");
      session_start();
      $id_sesion = $_SESSION['id_sesion'];
      session_unset();
      $this->consultar("DELETE FROM sesion WHERE sesion_id = $id_sesion;");
   }

   function validando() {
      session_name("sesionACM");
      session_start();
      $_SESSION['validando'] = 'Estoy validando mi inscripcion';
   }

   function estaValidando() {
      session_name("sesionACM");
      session_start();
      return $_SESSION['validando'] == 'Estoy validando mi inscripcion';
   }

   function mostrar_form_sesion() {
     $this->a_vista("sesion/form_sesion");
   }

   function actualizarNombre($nombre) {
     session_name("sesionACM");
     @session_start();
     $_SESSION['nombre'] = $nombre;
   }

   function mostrar_barra_menu($menu_actual) {
     $this->menu = $menu_actual;
     $items = $this->getMenus();
     if($items) {
        echo '<ul class="box">';
        while($item = pg_fetch_array($items)) {
            if(strtoupper($item['nom_menu']) == strtoupper($menu_actual)) {
                echo '<li id="active"><a href="'.strtolower($item['url_menu']).'">'.$item['nom_menu'].'<span class="tab-l"></span><span class="tab-r"></span></a></li>';
            }else {
                echo '<li><a href="'.strtolower($item['url_menu']).'">'.$item['nom_menu'].'<span class="tab-l"></span><span class="tab-r"></span></a></li>';
            }
        }
        echo '</ul>';
     }
   }

   function mostrar_usuario_activo() {
     //session_name('sesionACM');
     if(isset($_SESSION['nombre'])) {
          ?>
        <p id="rss"><strong><a href="sesion/gest_sesion.php?salir=ok" title="Cerrar sesion">Salir</a></strong></p>
        <hr class="noscreen" />
        <p id="breadcrumbs"><strong>Bienvenido usuario:</strong>
        <span class="user"><a href="index.php!item=4" title="Ver usuario"><?= $_SESSION['nombre']?> </a></span>
        <span class="rol"><a href="index.php!accion=modificar" title="Editar Perfil">perfil</a></span>
        </p>
          <?php
      }
   }

   function mostrar_navegacion() {
		    $items = $this->getItems();
       	if(pg_num_rows($items) > 0) {
            echo '<h3><span>Navegacion</span></h3>';
    		    echo '<ul id="category">';
		        while($item = pg_fetch_array($items)) {
			         echo '<li><a href="'.$item['url_funcion'].'">'.$item['nombre_funcion'].'</a></li>';
		        }
		        echo '</ul>';
        }
   }

   function getMenus() {
     //session_name("sesionACM");
     @session_start();
     if(isset($_SESSION['id'])) {
       $id = $_SESSION['id_rol'];
       return $this->consultar("SELECT DISTINCT m.nom_menu, m.menu_id, m.url_menu
       FROM menu m, operacion_asignada oa, privilegios p, operacion o
       WHERE oa.rol_id = p.rol_id AND m.menu_id = o.menu_id AND oa.funcion_id = o.funcion_id
	     AND p.rol_id = $id ORDER BY m.menu_id;");
     }else {
       return $this->consultar("SELECT DISTINCT m.nom_menu, m.menu_id, m.url_menu
       FROM menu m, operacion_asignada oa, operacion o
       WHERE oa.rol_id = 6 AND m.menu_id = o.menu_id AND oa.funcion_id = o.funcion_id
        ORDER BY m.menu_id;");
     }
   }

   function getItems() {
     //session_name("sesionACM");
     @session_start();
     if(isset($_SESSION['id_rol'])) {
       $id = $_SESSION['id_rol'];
     }else {
       $id = 6;
     }
     return $this->consultar("SELECT * FROM operacion o, operacion_asignada oa, menu m
		 WHERE o.estado=true AND o.funcion_id = oa.funcion_id
		 AND o.menu_id = m.menu_id AND upper(m.nom_menu) = upper('$this->menu')
		 AND oa.rol_id = $id ORDER BY o.funcion_id;");
   }

   function getIDUsuario() {
     session_name("sesionACM");
     @session_start();
     return $_SESSION['id'];
   }
   
   function getIDRol() {
     //session_name("sesionACM");
     @session_start();
     return $_SESSION['id_rol'];
   }
   
   function estaEnSesion() {
     session_name("sesionACM");
     @session_start();
     return isset($_SESSION['id']);
   }

   function get_Usuarios_Sesion() {
     $sql = "SELECT * FROM sesion s, usuario_nominal un WHERE
     un.usr_id=s.usr_id ORDER BY s.fecha_sesion desc";
     return $this->consultar($sql);
   }

   function get_Limite_Usuario($inicio, $TAMANO_PAGINA) {
     $sql = "SELECT * FROM sesion s, usuario_nominal un WHERE
     un.usr_id=s.usr_id ORDER BY s.fecha_sesion desc LIMIT '$TAMANO_PAGINA' OFFSET '$inicio'";
     return $this->consultar($sql);
   }
   
   function actualizarPid() {
       session_name("sesionACM");
       @session_start();
       $sql = "UPDATE sesion SET proceso_id = pg_backend_pid() WHERE sesion_id =".$_SESSION['id_sesion'];
       $this->consultar($sql);
   }
}
?>