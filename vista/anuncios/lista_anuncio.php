<?php
if(!isset($sesion)) {
	header("Location:index.php");
}
?>
<div id="zona0">
<?= require("anuncios/rotator.php") ?>
</div>