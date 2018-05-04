<?php
if(!isset($sesion)) {
	header("Location:index.php");
}
?>
<h2><span>Actualizacion de Anuncios </span></h2><p>
<script type="text/javascript" src="publico/js/anuncio.js"></script>

<center>
<div id="transparencia">
    <div id="transparenciaMensaje"></div>
</div>
<?php
include("../controlador/anuncio/ControlAnuncio.php");

$TAMANO_PAGINA = 10;
//capturas la pagina en la q estas

if (isset($_GET['pagina'])){
	  $pagina= $_GET["pagina"];
}else {
    $pagina='';
}

//si estas en la primera pagina le asignas los valores iniciales
if (!$pagina) {
    $inicio = 0;
    $pagina=1;
}else {
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

//consulta a la base de datos para ver cuantos registros hay
$controler = new ControlAnuncio();
$row=$controler->get_lista_anuncios_editables();
if($row) {
    $rows= @pg_fetch_array($row,0);
    $rows = $rows[0];
}

//cuantas paginas seran        
$total_paginas = ceil(pg_num_rows($row) / $TAMANO_PAGINA);
$items=$controler->get_limite_anuncios_editables($inicio, $TAMANO_PAGINA);

if($items) {
    if(pg_num_rows($items) == 0) {
        echo "<center><h3>No existen anuncios disponibles.</h3></center>";
    }else {
    ?>
      <table class="tabla" width="480">
      <tr class="cabecera">
        <td >Titulo: </td>
        <td >Fecha de inicio: </td>
        <td >Fecha de fin: </td>
        <td >Remitente: </td>
        <td >Modificar: </td>
        <td >Eliminar: </td>  
      </tr>
      
    <?php
        while($item = pg_fetch_array($items)) {
        ?>

        <tr>
            <td><?= $item['titulo_anuncio'] ?></td>
            <td><?= $item['ini_anuncio']?></td>
            <td><?= $item['fin_anuncio']?></td>
            <td><?= $item['remitente_anuncio']?></td>
            <td align="center">
            <form action="anuncios.php?item=2" method="post">
              <input type="hidden" name="anuncio_id" id="anuncio_id" value="<?= $item['anuncio_id']?>"/>
              <input name="modificar" type="submit" class="modificar" value="" alt="modificar"/>
            </form>
            </td>
            <td align="center">
              <input name="eliminar" type="button" class="eliminar" alt="eliminar" onclick='eliminar(<?= $item['anuncio_id']?>)' />
            </td>
        </tr>
        
       <?php
       }
       echo "</table>";
    }
}

//codigo de la paginacion
if($rows) {
        
      echo "<center><h3>";
            
      if(($pagina - 1) > 0) {
            echo "<a href='anuncios.php?item=4&pagina=".($pagina-1)."'><< Anterior</a> ";
      }
      
      for ($i=1; $i<=$total_paginas; $i++){
            if ($pagina == $i)
                echo ' <b>'.$pagina."</b> ";
            else
              echo "<a href='anuncios.php?item=4&pagina=$i'>$i</a> ";
      }
      
      if(($pagina + 1)<=$total_paginas) {
            echo " <a href='anuncios.php?item=4&pagina=".($pagina+1)."'>Siguiente >></a>";
      }

      echo "</h3></center>";

}
?>
<div id="mensajesAyuda">
  <div id="ayudaTitulo"></div>
  <div id="ayudaTexto"></div>
</div>
</center>