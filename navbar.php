	<?php
		if (isset($title))
		{
      date_default_timezone_set('America/Argentina/La_Rioja');
setlocale(LC_TIME, 'Spanish');
/* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	?>
  <?php 
$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
  $row=mysqli_fetch_array($query_empresa);
?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div></div>
      <a class="navbar-brand" href="index.php">"<?php echo $row['nombre_empresa']?>"</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <!--PERMISO A LOS USUARIOS QUE NO SON ADMINISTRADORES-->
      <?php if ($_SESSION['user_name']!='admin'):?> 
        <li class="<?php echo $active_Jugadores;?>"><a href="jugadores.php"><i class='glyphicon glyphicon-user'></i> Jugadores <span class="sr-only">(current)</span></a></li>
        <li class="<?php echo $active_fichajes;?>"><a href="fichajes.php"><i class='glyphicon glyphicon-barcode'></i> Fichajes </a></li>
        <li class="<?php echo $active_planilla;?>"><a href="planilla.php"><i class='glyphicon glyphicon-edit'></i> Carga de Planilla</a></li>
       <?php endif;  ?>
        <!--PERMISO A LOS USUARIOS QUE SON ADMINISTRADORES-->
        <?php if ($_SESSION['user_name']=='admin'):?> 
      
        <li class="<?php echo $active_usuarios;?>"><a href="usuarios.php"><i class='glyphicon glyphicon-list-alt'></i> Usuarios</a></li>
        <li class="<?php echo $active_cargajugador;?>"><a href="jugador.php"><i class='glyphicon glyphicon-list-alt'></i> Carga de Jugadores</a></li>
        <li class="<?php echo $active_cargafichajes;?>"><a href="fichas.php"><i class='glyphicon glyphicon-list-alt'></i> Carga de Fichajes</a></li>

        <li class="<?php echo $active_gastos;?>"><a href="registro_gastos.php"><i class='glyphicon glyphicon-list-alt'></i> Carga de Gastos</a></li>

        <li class="<?php echo $active_consultas;?>"><a href="consulta_planillas.php"><i class='glyphicon glyphicon-edit'></i> Reporte </a></li>
         <!--<li class="<?php echo $active_JBGastos;?>"><a href="jbzeus_gastos.php"><i class='glyphicon glyphicon-edit'></i> Reporte de Jbzeus</a></li>-->
         <li class="<?php echo $active_pases;?>"><a href="nueva_pases.php"><i class='glyphicon glyphicon-list-alt'></i> Pases</a></li>
         <li class="<?php echo $active_perfil;?>"><a href="perfil.php"><i class='glyphicon glyphicon-list-alt'></i>Configuracion</a></li>

       <?php endif;  ?>
        
       
         
		  </ul>
       
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://jbzeus.com/tienda/index.php?view=soporte" target='_blank'><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li>
        <li><a href="#" target='_blank'><i class='glyphicon glyphicon-user'></i> <?php echo $_SESSION['user_name'];?></a></li>
		    <li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>