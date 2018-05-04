<?php

    $fechaini = @date('d-m-Y');
    $fechafin = @date('d-m-Y');
    $horaini  = @date('H');
    $minini   = @date('i');
    $horafin  = @date('H');
    $minfin   = @date('i');
    
    if(isset($_POST['anuncio_id'])) {
        $fechaini =   substr($anuncio->ini_anuncio, 0, 10); 
        $horaini  =   substr($anuncio->ini_anuncio, 11, 12);
        $minini   =   substr($anuncio->ini_anuncio, 14, 15);
        $fechafin =   substr($anuncio->fin_anuncio, 0, 10); 
        $horafin  =   substr($anuncio->fin_anuncio, 11, 12); 
        $minfin   =   substr($anuncio->fin_anuncio, 14, 15);
        
    }

?>
  <tr>
    <td colspan="3">Disponibilidad</td>
  </tr>
    
  <tr>
    <td>Fecha de inicio:(*)</td>
    <td class="campo">
    <input class="inputNormal" name="fechaini" id="fechaini" size="15" type="text" readonly="readonly" value="<?= $fechaini ?>" />
                <button id="fechainicio_trigger" type="button">...</button>
                <script type="text/javascript">
                  new Calendar({
                          inputField: "fechaini",
                          dateFormat: "%Y-%m-%d",
                          trigger: "fechainicio_trigger",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                  this.hide();
                          }
                  });
                </script>
     </td>
     <td class="ayuda"><img src="publico/design/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Fecha Inicio')"></td>
  </tr>
    
    <tr>
        <td>Hora de inicio: (*) </td>
        <td><?php $nom="ini"; $hora=$horaini; $min=$minini; include("form_hora.php");?></td>
        <td class="ayuda"><img src="publico/design/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Hora Inicio')"></td>
    </tr>

    <tr>
        <td>Fecha de fin: (*) </td>
        <td class="campo">
        <input class="inputNormal" name="fechafin" id="fechafin" size="15" type="text" readonly="readonly" value="<?= $fechafin ?>"/>
                <button id="fechafin_trigger" type="button">...</button>
                <script type="text/javascript">
                  new Calendar({
                          inputField: "fechafin",
                          dateFormat:  "%Y-%m-%d",
                          trigger: "fechafin_trigger",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                  this.hide();
                          }
                  });

                </script>
          </td>
          <td class="ayuda"><img src="publico/design/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Fecha Fin')"></td>
    </tr>

    <tr>
        <td>Hora de Fin: (*) </td>
        <td><?php $nom="fin"; $hora=$horafin; $min=$minfin; include("form_hora.php");?></td>
         <td class="ayuda"><img src="publico/design/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Hora Fin')"></td>
    </tr>
