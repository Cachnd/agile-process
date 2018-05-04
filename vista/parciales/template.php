<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="cs" />
    <meta name="robots" content="all,follow" />
    
    <title>ACM</title>
    <meta name="description" content="..." />
    <meta name="keywords" content="..." />

    <link rel="stylesheet" media="screen,projection" type="text/css" href="publico/css/main.css" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="publico/css/tabla.css" />
    <link rel="stylesheet" media="screen,projection" type="text/css" href="publico/css/ayuda.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="publico/css/reglamento.css" />
    <link type="text/css" rel="stylesheet" href="publico/css/jscal2.css" />

	<script src="publico/js/jscal2.js"></script>
    <script src="publico/js/es.js"></script>
	<script src="publico/js/jquery.js"></script>
	<script type="text/javascript" src="publico/js/ayuda.js"></script>
	<script type="text/javascript" src="publico/js/funciones.js"></script>

</head>

<body id="www-url-cz">

<!-- Main -->
<div id="main" class="box">

    <!-- Header -->
    <div id="header">

        <hr class="noscreen" />          

        <!-- Quick links -->
        <div class="noscreen noprint">
            <p><em>Usuario: <a href="#content">Jaime</a>, <a href="#tabs">Navegacion</a>.</em></p>
            <hr />
        </div>

    </div> <!-- /header -->

     <!-- Main menu (tabs) -->
     <div id="tabs" class="noprint">

            <h3 class="noscreen">Navigation</h3>
            <?php       
              
              $sesion = new ControlSesion();
              $sesion->mostrar_barra_menu("$this->menu");
            ?>

        <hr class="noscreen" />
     </div> <!-- /tabs -->

    <!-- Page (2 columns) -->
    <div id="page" class="box">
    <div id="page-in" class="box">

        <div id="strip" class="box noprint">

            <!-- Usuario Activo -->
            <?php $sesion->mostrar_usuario_activo();?>
      <hr class="noscreen" />
            <hr class="noscreen" />
			 <!-- Breadcrumbs -->
			
			<hr class="noscreen" />
		</div> <!-- /strip -->
 
    
        <!-- Content -->
        <div id="content">

            <!-- Article -->
            <div class="article">
          
				    <?php include ("$this->contenido")?>
				  
            </div> <!-- /article -->
        </div> 
		<!-- /content -->

        <!-- Right column -->
        <div id="col" class="noprint">
          
            <div id="col-in">    
				  <?php 
				    $sesion->mostrar_form_sesion();
				  ?>
			
			      <!-- Navegacion -->
            <?php
              $sesion->mostrar_navegacion();
            ?>
            <!-- Archive -->
            <h3><span>Calendario</span></h3>
            
				      <div id="calendario">
				      <?php include("parciales/calendario.php");?> 
				      </div>
            </div> <!-- /col-in -->

        </div> <!-- /col -->

    </div> <!-- /page-in -->
    </div> <!-- /page -->

    <!-- Footer -->
    <div id="footer">
        <div id="top" class="noprint"><p><span class="noscreen">Ir arriba</span> <a href="#header" title="Ir arriba ^">^<span></span></a></p></div>
        <hr class="noscreen" />
        
        <p id="createdby">Creado por <a href="#">PAHJ</a></p>
        <p id="copyright"></p>
    </div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
