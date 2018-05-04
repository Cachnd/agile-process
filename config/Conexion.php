<?php
class Conexion{
		
	private $enlace;
	private static $conexion;

	function Conexion() {
	    include("config.php");
      if(self::$conexion == NULL) {
        $this->enlace = pg_connect("host=$server port=$port user=$user password=$passw dbname=$data_base");
        self::$conexion=$this->enlace;
      }else {
        $this->enlace=self::$conexion;
      }

	}

	function consultar($sql){
		$consulta = pg_query($this->enlace,$sql);
		return $consulta;
	}

  function cerrar() {
    pg_close($this->enlace);
  }
	
}
?>
