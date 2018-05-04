<?php
class Controlador {

  var $conexion;
  var $error;

  function a_vista($vista) {
    include("../vista/".$vista.".php");
  }

  function consultar($sql) {
    $this->conexion= new Conexion();
    return $this->conexion->consultar($sql);  
  }

  function indicarError() {
    return $this->error;
  }
  
}
?>