<?php
class Validador extends Controlador {
  
    function existeCorreo($correo) {
      $res = $this->consultar("SELECT * FROM usuario_nominal WHERE correo_usr = '$correo' ;");
      return ( pg_num_rows($res) > 0 );
    }
}
?>