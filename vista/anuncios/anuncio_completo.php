
<?php
   $id=$_POST['anuncio_id'];
   include("../../config/Conexion.php");
   include("../../controlador/Controlador.php");
   include("../../controlador/anuncio/ControlAnuncio.php");
   $controler = new ControlAnuncio();
   $items = $controler->get_anuncio($id);
   $item = pg_fetch_array($items, 0);
?>
<div class="zona0">
    <h2> <span > <?= $item['titulo_anuncio']?></span></h2>
    <p class="info noprint">
         <span class="comentario"></span>
         <span class="date"><?= substr($item['ini_anuncio'],0,10)?> al <?= substr($item['fin_anuncio'],0,10)?></span>
                             <span class="noscreen">,</span>
         <span class="user"><?= $item['remitente_anuncio']?></span>
                             <span class="noscreen">,</span>
    </p>
    <p><?= $item['descripcion_anuncio']?></p>
</div>