<?php
if(!isset($sesion)) {
	header("Location:index.php");
}
?>
<script type="text/javascript" src="publico/js/anuncio.js"></script>
<script type="text/javascript">
    ayudaFormAnuncio();
</script>

<h2><span>Registro de Anuncio</span></h2><p>
<center>

<div id="transparencia">
    <div id="transparenciaMensaje"></div>
</div>

<fieldset style=" width: 480px; margin-top: 0px;">
<legend>Ingrese los datos del anuncio</legend>
<form name="formulario" id="formulario" method="post" >
<table align="center">
  
	<tr>
        <td><label> Titulo: (*) </label></td>
        <td class="campo"><input class="inputNormal" name="titulo" id="titulo" type="text" size="30" maxlength="100"/></td>
        <td class="ayuda"><img src="publico/design/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Titulo')"></td>
    </tr>

	<tr>
        <td><label> Descripcion: (*) </label></td>
        <td class="campo"><textarea class="inputNormal" name="descripcion" id="decripcion" type="text" cols="34" rows="4"></textarea></td>
        <td class="ayuda"><img src="publico/design/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Descripcion')"></td>
    </tr>

	<tr>
        <td><label>Remitente: </label></td>
        <td class="campo"><input class="inputNormal" name="remitente"  id="remitente"  type="text" size="30" maxlength="50" value="Administrador del Sitio" /></td>
        <td class="ayuda"><img src="publico/design/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Remitente')"></td>
    </tr>

    <tr><td colspan="3">&nbsp;</td></tr>
	<tr>
	    <td colspan="3"><?php include("parciales/form_disponibilidad.php");?></td>
	</tr>
	
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr><td colspan="3">&nbsp;</td></tr>

    <tr>
        <td><input name="agregar" type="button" value="Registrar" class="button" onclick="validarForm()"/></td>
        <td class="der" colspan="2"><input name="cancelar" type="button" value="Cancelar" class="button" onclick="irAnuncios()"/></td>
    </tr>

</table>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>
</form>
</fieldset>
</center>
