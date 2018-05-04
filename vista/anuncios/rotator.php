<?php
if(!isset($sesion)) {
	header("Location:index.php");
}
?>
<script language="JavaScript" src="publico/archivos/script.js" type="text/javascript"></script>
<script src="publico/js/anuncio_completo.js"></script>
<h2><span>Lista de anuncios</span></h2><p>
<td align="center" valign="top" style="height:90%; width:470px">
<table style="height:100%; width:98%" align="center" cellpadding="0" cellspacing="0" border="0" class="fondo_central">
<tr><td valign="top" align="center">
</td></tr>


<?php

     include("../controlador/anuncio/ControlAnuncio.php");

     $controler = new ControlAnuncio();

     $items = $controler->get_lista_anuncios();

     $vercontroles = TRUE;
     if($items) {
        if(pg_num_rows($items) == 0) {
          $vercontroles = FALSE;
          echo "<center><h3>No existen anuncios disponibles.</h3></center>";
        }
?>

    <script language="JavaScript" type="text/javascript">
    <!--
    setTamAviso(200);
    setNumAvisos(<?= pg_num_rows($items) ?>);
    timerID = setTimeout("moverAvisos()", 1000);
    -->
    </script>
    <tr><td>
            <table width="100%" cellpadding="0" cellspacing="0"><tr>
                <td style="width: 97%" onmouseover="normal()">
                        <div style="position:relative; overflow:hidden; width:100%; height:390px;">

        <?php
        $var=0;
        $aux=0;
        while($item = pg_fetch_array($items)) {
            ?>

           <div class="anuncio" id="aviso<?=$aux?>" style="position:absolute; height:180px; top:<?=$var?>px; width:90%; left:2.5%;">
                  <h2><span><?= $item['titulo_anuncio']?></span></h2>
			     <p class="info">
			               <span class="comentario"></span>
                     <span class="date"><?= substr($item['ini_anuncio'],0,10)?> al <?= substr($item['fin_anuncio'],0,10)?></span>
					           <span class="noscreen">,</span>
                     <span class="user"><?= $item['remitente_anuncio']?></span>
					           <span class="noscreen">,</span>
           </p>
                   <?php
                    $cadena = $item['descripcion_anuncio'];
                    $longitud = strlen($cadena);
                    $max = 100;
                    $leerMas = false;
                    if($longitud>$max) {
                        $array = str_split($cadena, $max);
                        $cadena = $array[0];
                        $leerMas = true;
                    }
                    if($leerMas) { ?>
                        <p><?= strip_tags($cadena)?>........</p>
                        <input name="verTodo" type="button" value="Ver todo" class="button" onclick="verTodo(<?= $item['anuncio_id']?>)" />
                   <?php
                   }else  {  ?>
                        <p><?= $cadena?></p>
                    <?php
                   }
                   ?>
           </div>
            <?php
            $var=$var+200;
            $aux=$aux+1;
        }
        echo '<hr class="noscreen" /> ';
    }else {
		  header("Location:index.php?accion=errorbd");
    }
?>
                        </div>
                    </td>
      <?php if($vercontroles) {
			?>
                    <td style="width: 3%">
                        <table style="height: 390px" border="0" cellpadding="0" cellspacing="0">
                            <tr style="height: 20%"><td><img id="masarriba" alt="Arriba Rapido" src="publico/imagenes/masarriba.jpg" style="opacity:0.3; filter:alpha(opacity=29);" onmouseover="control_aviso('masarriba')" onmousedown="control_aviso('masarriba')" onmouseout="control_salir_aviso('masarriba')" /></td></tr>
                            <tr style="height: 20%"><td><img id="arriba" alt="Arriba" src="publico/imagenes/arriba.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('arriba')" onmousedown="control_aviso('arriba')" onmouseout="control_salir_aviso('arriba')" /></td></tr>
                            <tr style="height: 20%"><td><img id="alto" alt="Detener" src="publico/imagenes/alto.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('alto')" onmousedown="control_aviso('alto')" onmouseout="control_salir_aviso('alto')" /></td></tr>
                            <tr style="height: 20%"><td><img id="abajo" alt="Abajo" src="publico/imagenes/abajo.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('abajo')" onmousedown="control_aviso('abajo')" onmouseout="control_salir_aviso('abajo')" /></td></tr>
                            <tr style="height: 20%"><td><img id="masabajo" alt="Abajo Rapido" src="publico/imagenes/masabajo.jpg" style="opacity:0.3; filter:alpha(opacity=29)" onmouseover="control_aviso('masabajo')" onmousedown="control_aviso('masabajo')" onmouseout="control_salir_aviso('masabajo')" /></td></tr>
                        </table>
                    </td>
  
		  <?php
			}
      ?>
                </tr>
            </table>            
    </td></tr>
    
</table>

</td></tr>
</table></td></tr>