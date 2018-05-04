<?php
  //session_name('sesionACM');
  if(!isset($_SESSION['nombre'])) {
?>
<script type="text/javascript" src="publico/js/sesion.js"></script>
<h3><span>Identificate</span></h3>
<div id="transparenciaSesion">
    <div id="transparenciaMensajeSesion"></div>
</div>
<form id="formularioSesion">
<table border="0" width="170">
  
  <tr><td>Correo: </td></tr>
  
  <tr>
    <td><input name="correo" id="correo" type="text" maxlength="40" size="20"></td>
  </tr>
  
  <tr><td>Contrase&#241;a:</td></tr>
  
  <tr>
    <td><input id="clave" type="password" maxlength="20" size="20"></td>
  </tr>
  
  <tr>
    <td><input value="Aceptar" name="logear" type="button" class="button" onclick="validaSesion()"></td>
  </tr>
  
  <tr>
    <!--<td><a href="index.php?accion=registrar">Registrarse</a></td>-->
    <td><a href="index.php!accion=registrar">Registrarse</a></td>
  </tr>
  
  <tr>
    <!--<td><a href="index.php?item=5"> &#191; Olvido su contrase&#241;a ?</a></td>-->
    <td><a href="index.php!item=5"> &#191; Olvido su contrase&#241;a ?</a></td>
  </tr>
  
</table>
</form>
<hr class="noscreen" />
<br /> 

<?php
  }
?>