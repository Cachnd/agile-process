<?php
class ControlAnuncio extends Controlador{

    function registrar($anuncio) {
        $a = $anuncio->fechaini." ".$anuncio->horaini.":00-04" ;
        $b =$anuncio->fechafin." ".$anuncio->horafin.":00-04";
        $sql = "INSERT INTO anuncio(titulo_anuncio,descripcion_anuncio, remitente_anuncio,ini_anuncio,fin_anuncio) VALUES(
        '$anuncio->titulo','$anuncio->descripcion','$anuncio->remitente','$a','$b')";

        if ($this->consultar($sql))
            return true;
        else
            return false;
    }

    function get_lista_anuncios() {
        $sql = "SELECT titulo_anuncio, descripcion_anuncio, ini_anuncio, fin_anuncio, remitente_anuncio, anuncio_id
                FROM anuncio
                WHERE current_timestamp >= ini_anuncio  AND
                      current_timestamp <= fin_anuncio
                ORDER BY anuncio_id DESC;";
        return $this->consultar($sql);
    }

    function get_anuncio($id) {
        $sql = "SELECT titulo_anuncio, descripcion_anuncio, ini_anuncio, fin_anuncio, remitente_anuncio, anuncio_id 
                FROM anuncio
                WHERE anuncio_id = $id";
        return $this->consultar($sql);
    }
    
    function get_anuncio_obj($id) {
        $sql = "SELECT titulo_anuncio, descripcion_anuncio, ini_anuncio, fin_anuncio, remitente_anuncio, anuncio_id 
                FROM anuncio
                WHERE anuncio_id = $id";
        $sqlretorno = $this->consultar($sql);
        
        $sqlarray = pg_fetch_array($sqlretorno,0);
        $anuncio = new Anuncio();
        $anuncio->titulo        = $sqlarray["titulo_anuncio"];
        $anuncio->remitente     = $sqlarray["remitente_anuncio"];
        $anuncio->descripcion   = $sqlarray["descripcion_anuncio"];
        $anuncio->ini_anuncio   = $sqlarray["ini_anuncio"];
        $anuncio->fin_anuncio   = $sqlarray["fin_anuncio"];
        $anuncio->anuncio_id    = $sqlarray["anuncio_id"];
        return $anuncio;
    }
    
    function get_lista_anuncios_editables() {
        $sql = "SELECT anuncio_id, titulo_anuncio, descripcion_anuncio, ini_anuncio, fin_anuncio, remitente_anuncio
                FROM anuncio
                WHERE ini_anuncio >= current_date AND current_date<=fin_anuncio AND actividad_id=0 
                ORDER BY ini_anuncio";
        return $this->consultar($sql);
    }
    
    function get_limite_anuncios_editables($inicio, $TAMANO_PAGINA) {
        $sql = "SELECT anuncio_id, titulo_anuncio, descripcion_anuncio, ini_anuncio, fin_anuncio, remitente_anuncio
                FROM anuncio
                WHERE ini_anuncio >= current_date AND current_date<=fin_anuncio AND actividad_id=0
                ORDER BY ini_anuncio
                LIMIT '$TAMANO_PAGINA' OFFSET '$inicio'";
        return $this->consultar($sql);
    }
    
    function eliminarAnuncio($anuncio) {
        $sql = "DELETE FROM anuncio WHERE anuncio_id='$anuncio'";
        if ($this->consultar($sql))
            return true;
        else
          return false;
    }
    
    function actualizarRegistro($anuncio) {
        $sql = "UPDATE anuncio SET titulo_anuncio = '$anuncio->titulo', descripcion_anuncio = '$anuncio->descripcion',
        remitente_anuncio = '$anuncio->remitente', ini_anuncio = '$anuncio->ini_anuncio', fin_anuncio= '$anuncio->fin_anuncio' WHERE anuncio_id = '$anuncio->anuncio_id'";
        return $this->consultar($sql);
    }
}
?>
